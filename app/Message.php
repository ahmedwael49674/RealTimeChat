<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['friend_id', 'user_id', 'content'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function friend()
    {
        return $this->belongsTo('App\Friend');
    }
}
