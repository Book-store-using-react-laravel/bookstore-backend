<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_number',
        'member_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
