<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookImage;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'price',
        'stock',
        'images.*'
    ];

    public function images(){
        return $this->hasMany(BookImage::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($book) {
            // Delete all images associated with this book
            $book->images->each->delete();
        });
    }
}

// $book = new Book;
// $book->title = 'Sample Book';
// $book->author = 'John Doe';
// $book->price = 19.99;
// $book->stock = 10;
// $book->save();
