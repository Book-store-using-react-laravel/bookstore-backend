<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Retrieve and return all books
    public function index()
    {
        $books =  Book::with('images')->get();
        return response()->json($books, 200);
    }

    // Create a new book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'images.*'=> 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // create a new book and save it
        $book =  new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->save();

        //handle image uploads
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $orinalFileName = $image->getClientOriginalName();
                $path = $image->storeAs('book_images', $orinalFileName, 'public');
                $book->images()->create(['image_path'=>$path]);
            }
        }

        return response()->json($book,201);
    }

    // Search specific book
    public function show($id)
    {
        $book = Book::with('images')->find($id);
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle removal of existing images
        $existingImageIds = $book->images->pluck('id')->toArray();
        $imagesToDelete = $request->input('images_to_delete', []);
        foreach ($imagesToDelete as $imageId) {
            $book->images()->find($imageId)->delete();
        }

        $book->title = $request->title;
        $book->author = $request->author;
        $book->price = $request->price;
        $book->stock = $request->stock;
        $book->save();

        // Handle addition of new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $originalFileName = $image->getClientOriginalName();
                $path = $image->storeAs('book_images', $originalFileName, 'public');
                $book->images()->create(['image_path' => $path]);
            }
        }

        return response()->json($book, 200);
    }

    // Delete a book using id
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
