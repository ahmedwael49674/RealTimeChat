<?php

namespace App\Http\Controllers;

use App\{User,Status,Friend,Message};
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
        $user                   =   User::with('status:id,name')->findOrFail(auth::id());
        $LastFriendConversation =   Friend::whereUserOne(auth::id())
                                            ->orWhere('user_two',auth::id())
                                            ->whereHas('messages')
                                            ->latest()
                                            ->first();
        $FriendId               =   $LastFriendConversation->user_one  ==  auth::id() ? $LastFriendConversation->user_two : $LastFriendConversation->user_one;
        $LastFriend             =   User::findOrFail($FriendId);
        $statuses               =   Status::all();
        return view('home',compact('user','statuses','LastFriend','LastFriendConversation'));
    }
}
