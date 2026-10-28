<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data penulis',
            'data' => $authors,
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|string|max:255',
        ]);

        $author = Author::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan penulis',
            'data' => $author,
        ], 201);
    }
}
