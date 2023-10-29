<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Book;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
use App\Http\Controllers\BookController;

Route::resource('books','App\Http\Controllers\BookController')->except(['create','edit']);

//  breakdown of the routes created by 'Route::resource'

// GET /api/books - Retrieves all books (index method).
// POST /api/books - Creates a new book (store method).
// GET /api/books/{book} - Retrieves a specific book (show method).
// PUT /api/books/{book} - Updates a specific book (update method).
// DELETE /api/books/{book} - Deletes a specific book (destroy method)
