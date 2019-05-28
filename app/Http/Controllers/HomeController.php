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
        $user               =   User::with('status:id,name')->findOrFail(auth::id());
        $friends            =   Friend::whereUserOne(auth::id())
                                        ->OrWhere('user_two','=',auth::id())
                                        ->with('user.status:id,name')
                                        ->with(['messages' => function ($query) {
                                            $query->pluck('id','content');
                                            $query->latest();}])
                                        ->whereHas('messages')
                                        ->get();

        $LastFriend            =   Friend::whereUserOne(auth::id())
                                            ->orWhere('user_two',auth::id())
                                            ->whereHas('messages')
                                            ->with('messages.user')
                                            ->latest()
                                            ->first();

        $statuses           =   Status::all();
        return view('home',compact('user','statuses','friends','LastFriend'));
    }
}
