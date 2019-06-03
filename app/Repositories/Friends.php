<?php

namespace App\Repositories;

class Friends
{
    public static function MergeFriends($friendsOne, $friendsTwo)
    {
        foreach($friendsOne as $friend){
            $friend->user           = $friend->userTwo;   
            unset($friend->userTwo);
        }

        foreach($friendsTwo as $friend){
            $friend->user           = $friend->userOne;   
            unset($friend->userOne);
        }

        return $friendsTwo->merge($friendsOne);
    }
}