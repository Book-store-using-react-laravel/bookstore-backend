<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Retrieve and return all books
    public function index()
    {
        $books =  Book::all();
        return response()->json($books, 200);
    }

    // Create a new book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $book =  new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->save();

        return response()->json($book,201);
    }

    // Search specific book
    public function show($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book, 200);
    }

    // Update a book
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if(!$book){
            return response() -> json(['message' => 'Book not found'], 404);
        }

        $request->validate([
            'title'=>'required',
            'author'=>'required',
            'price'=>'required|numeric',
            'stock'=>'required|integer',
        ]);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->save();

        return response()->json($book, 200);
    }

    // Delete a book
    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted'], 200);
    }
}
