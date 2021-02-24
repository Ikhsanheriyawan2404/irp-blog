<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'slug', 'meta_title', 'meta_description', 'meta_keyword', 'category', 'thumbnail', 'body'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function comment($postId)
    {
        return $this->comments()->where('post_id', $postId);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getTakeImageAttribute()
    {
        return '/storage/' . $this->thumbnail;
    }
}
