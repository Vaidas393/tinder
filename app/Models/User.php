<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Allow mass assignment for all fields
    protected $guarded = [];

    // Hide sensitive fields
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casts
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Reactions (likes/dislikes) this user has given.
     */
    public function reactionsGiven()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    public function likesGiven()
    {
        return $this->reactionsGiven()->where('type', 'like');
    }

    public function dislikesGiven()
    {
        return $this->reactionsGiven()->where('type', 'dislike');
    }

    /**
     * Reactions (likes/dislikes) this user has received.
     */
    public function reactionsReceived()
    {
        return $this->hasMany(Like::class, 'target_user_id');
    }

    public function likesReceived()
    {
        return $this->reactionsReceived()->where('type', 'like');
    }

    public function dislikesReceived()
    {
        return $this->reactionsReceived()->where('type', 'dislike');
    }

    /**
     * Shortcut many-to-many for liked/disliked users.
     */
    public function likedUsers()
    {
        return $this->belongsToMany(
            User::class,
            'likes',
            'user_id',
            'target_user_id'
        )
        ->wherePivot('type', 'like')
        ->withTimestamps();
    }

    public function dislikedUsers()
    {
        return $this->belongsToMany(
            User::class,
            'likes',
            'user_id',
            'target_user_id'
        )
        ->wherePivot('type', 'dislike')
        ->withTimestamps();
    }
}