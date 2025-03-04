<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = ['title', 'author_id', 'published_at'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }
}
