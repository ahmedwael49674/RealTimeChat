<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use Auth;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends                =   Friend::whereUserOne(auth::id())
                                            ->OrWhere('user_two','=',auth::id())
                                            ->with('user.status:id,name')
                                            ->with(['LastMessage' => function ($query) {
                                                $query->pluck('id','content');}])
                                            ->whereHas('messages')
                                            ->get();
        return $friends->toJson();
    }

}
