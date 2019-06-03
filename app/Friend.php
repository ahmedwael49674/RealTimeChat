<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    
    protected $fillable = ['user_one', 'user_two'];

    public function userOne()
    {
        return $this->belongsTo('App\User','user_one');
    }

    public function userTwo()
    {
        return $this->belongsTo('App\User','user_two');
    }
    
    public function messages()
    {
        return $this->hasMany('App\Message','friend_id')->latest();
    }
    
    public function LastMessage()
    {
        return $this->hasOne('App\Message','friend_id')->latest();
    }

}
