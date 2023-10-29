<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'price',
        'stock',
    ];
}

// $book = new Book;
// $book->title = 'Sample Book';
// $book->author = 'John Doe';
// $book->price = 19.99;
// $book->stock = 10;
// $book->save();
