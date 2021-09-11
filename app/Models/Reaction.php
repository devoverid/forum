<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'reactionable_id',
        'reactionable_type',
        'type'
    ];

    /**
     * Get all of the owning reactionable models.
     *
     * @return void
     */
    public function reactionable()
    {
        return $this->morphTo();
    }
}
