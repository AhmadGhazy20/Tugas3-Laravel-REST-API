<?php

namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = (new Genre())->getGenres();

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengambil data genre',
            'data' => $genres,
        ], 200);
    }
}
