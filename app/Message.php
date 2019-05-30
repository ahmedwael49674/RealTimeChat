<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Message extends Model
{
    protected $appends = ['is_auth'];

    protected $fillable = ['friend_id', 'user_id', 'content'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function friend()
    {
        return $this->belongsTo('App\Friend');
    }

    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function getIsAuthAttribute()
    {
        return $this->attributes['user_id'] == auth::id()? true:false;
    }
}
