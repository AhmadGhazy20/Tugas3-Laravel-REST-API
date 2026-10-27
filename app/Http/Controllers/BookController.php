<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->get();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data buku',
            'data' => $books,
        ], 200);
    }
}
