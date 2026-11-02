<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/books', [BookController::class, 'index']);

// Author: Read All dan Show bisa diakses publik
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{author}', [AuthorController::class, 'show']);

// Genre: Read All dan Show bisa diakses publik
Route::get('/genres', [GenreController::class, 'index']);
Route::get('/genres/{genre}', [GenreController::class, 'show']);

// CRUD Author dan Genre hanya untuk admin
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/authors', [AuthorController::class, 'store']);
    Route::put('/authors/{author}', [AuthorController::class, 'update']);
    Route::patch('/authors/{author}', [AuthorController::class, 'update']);
    Route::delete('/authors/{author}', [AuthorController::class, 'destroy']);

    Route::post('/genres', [GenreController::class, 'store']);
    Route::put('/genres/{genre}', [GenreController::class, 'update']);
    Route::patch('/genres/{genre}', [GenreController::class, 'update']);
    Route::delete('/genres/{genre}', [GenreController::class, 'destroy']);
});

// Transaction: Create, Update, Show hanya untuk customer
Route::middleware(['auth:sanctum', 'role:customer'])->group(function () {
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/transactions/{id}', [TransactionController::class, 'show']);
    Route::put('/transactions/{id}', [TransactionController::class, 'update']);
    Route::patch('/transactions/{id}', [TransactionController::class, 'update']);
});

// Transaction: Read All dan Destroy hanya untuk admin
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);
});
