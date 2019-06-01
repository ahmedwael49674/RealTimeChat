<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Status,User};
use Auth;

class StatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses               =   Status::all();
        return $statuses->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $status             =   Status::findOrFail($request->statusId);
        $user               =   User::findOrFail(Auth::id());
        $user->status_id    =   $request->statusId;
        $user->save();
        return $status->name;
    }
}
