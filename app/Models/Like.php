<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id','target_user_id','type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function target()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }
}