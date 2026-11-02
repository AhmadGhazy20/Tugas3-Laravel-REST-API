<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    // Read All Transactions
    public function index()
    {
        $transactions = Transaction::with(['user', 'book'])->get();

        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }

    // Create Transaction
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated'
            ], 401);
        }

        $book = Book::find($request->book_id);

        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok barang tidak cukup'
            ], 400);
        }

        $totalAmount = $book->price * $request->quantity;

        $book->stock -= $request->quantity;
        $book->save();

        $transaction = Transaction::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'transaction created successfully',
            'data' => $transaction
        ], 201);
    }

    // Show Transaction
    public function show($id)
    {
        $transaction = Transaction::with(['user', 'book'])->find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $transaction
        ]);
    }

    // Update Transaction
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $book = Book::find($transaction->book_id);

        $oldQuantity = $transaction->quantity;
        $newQuantity = $request->quantity;

        $availableStock = $book->stock + $oldQuantity;

        if ($availableStock < $newQuantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stok barang tidak cukup'
            ], 400);
        }

        $book->stock = $availableStock - $newQuantity;
        $book->save();

        $transaction->quantity = $newQuantity;
        $transaction->total_amount = $book->price * $newQuantity;
        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully',
            'data' => $transaction
        ]);
    }

    // Destroy Transaction
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Transaction not found'
            ], 404);
        }

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ]);
    }
}
