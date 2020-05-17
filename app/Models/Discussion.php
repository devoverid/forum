<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = [ 'user_id', 'title', 'content', 'slug', 'view', 'solved_at' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'discussion_tag');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'ASC');
    }
}
