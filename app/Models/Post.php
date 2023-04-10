<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Likes::class);
    }
    
    public function likesCount()
    {
        return $this->likes()->count();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function commentsCount()
    {
        return $this->comments->count();
    }
    public function savedPosts()
    {
        return $this->hasMany(SavedPost::class);
    }
    public function savedBy()
    {
        return $this->hasMany(SavedPost::class);
    }
}
