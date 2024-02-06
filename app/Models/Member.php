<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact_number',
        'member_id',
        'books',
        'borrowed_date',
        'returned_date',
    ];

    protected $casts = [
        'books' => 'json', 
        'borrowed_date' => 'datetime',
        'returned_date' => 'datetime', 
    ];
}
