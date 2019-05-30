<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;
use App\Events\newMessage;
use App\{Message,Friend};
use Auth;

class MessagesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message                =   new Message();
        $message->content       =   $request->content;
        $message->friend_id     =   $request->friendId;
        $message->user_id       =   auth::id();
        $message->save();
        $message->load('user');
        event(new newMessage($message));
        return 'true';
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $LastAuthConversationId        =   Message::WhereHas('friend',function($query){
                                                $query->whereUserOne(auth::id());
                                                $query->Orwhere('user_two','=',auth::id());})
                                            ->latest()
                                            ->first()
                                            ->friend_id;

        $messages                      =    Message::whereFriendId($LastAuthConversationId)->with('user')->oldest()->get();
        return $messages->toJson();
    }
}
