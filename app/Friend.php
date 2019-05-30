<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    
    protected $fillable = ['user_one', 'user_two'];

    public function user()
    {
        return $this->belongsTo('App\User','user_one');
    }
    
    public function messages()
    {
        return $this->hasMany('App\Message','friend_id');
    }
    
    public function LastMessage()
    {
        return $this->hasOne('App\Message','friend_id')->latest();
    }

}
