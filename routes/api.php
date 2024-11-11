<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Http\Controllers\BookController;
use App\Http\Controllers\API\AuthController;


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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('member', [AuthController::class, 'member']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::resource('books', 'App\Http\Controllers\BookController')->except(['create', 'edit']);

// write a markdown to give link to access postman api documentation
// [Postman API Documentation](https://documenter.getpostman.com/view/15596400/TzJx8w7T)

//this route breakdown of the routes created by 'Route::resource'

// GET /api/books - Retrieves all books (index method).
// POST /api/books - Creates a new book (store method).
// GET /api/books/{book} - Retrieves a specific book (show method).
// PUT /api/books/{book} - Updates a specific book (update method).
// DELETE /api/books/{book} - Deletes a specific book (destroy method)
