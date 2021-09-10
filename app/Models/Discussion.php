<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Discussion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'slug',
        'view',
        'solved_at',
        'best_answer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'discussion_tags');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->orderBy('created_at', 'ASC');
    }

    public function comment_best_answer()
    {
        return $this->belongsTo(Comment::class, 'best_answer', 'id');
    }

    /**
     * Get reactions for the discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reactions()
    {
        return $this->hasMany(DiscussionReaction::class);
    }
}
