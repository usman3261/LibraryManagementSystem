<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 
        'author_name', 
        'image', 
        'status'
    ];

    public function borrows()
    {
        return $this->hasMany(Borrowed::class, 'bookId');
    }
}