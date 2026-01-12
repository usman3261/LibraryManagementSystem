<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowed extends Model
{
    protected $table = 'borrowed';

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'bookId');
    }
}