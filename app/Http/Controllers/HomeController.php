<?php

namespace App\Http\Controllers;

use App\{User,Friend};
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $LastFriendConversation =   Friend::whereUserOne(auth::id())
                                            ->orWhere('user_two',auth::id())
                                            ->whereHas('messages')
                                            ->latest()
                                            ->first();
        $FriendId               =   $LastFriendConversation->user_one  ==  auth::id() ? $LastFriendConversation->user_two : $LastFriendConversation->user_one;
        $LastFriend             =   User::findOrFail($FriendId);
        return view('home',compact('LastFriend','LastFriendConversation'));
    }
}
