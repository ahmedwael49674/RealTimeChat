<?php

namespace App\Http\Controllers;

use App\Repositories\Friends;
use Illuminate\Http\Request;
use App\Friend;
use Auth;
use DB;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friendsOne                =   Friend::whereUserOne(auth::id())
                                            ->with('userTwo.status:id,name')
                                            ->with('LastMessage')
                                            ->whereHas('messages')
                                            ->get();
        $friendsTwo                =   Friend::whereUserTwo(auth::id())
                                            ->with('userOne.status:id,name')
                                            ->with('LastMessage')
                                            ->whereHas('messages')
                                            ->get();
        $friends                    = Friends::MergeFriends($friendsOne, $friendsTwo);

        return $friends->toJson();
    }

}
