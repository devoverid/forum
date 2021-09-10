<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionReaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'discussion_id',
        'reaction'
    ];

    /**
     * Get Discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }

    /**
     * Get user who reacted.
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
