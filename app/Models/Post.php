<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // This is to allow this data to be mass assigned
    protected $fillable = ['title', 'body', 'user_id'];

    // Associate a post with a user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
