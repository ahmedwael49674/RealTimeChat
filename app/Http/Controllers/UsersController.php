<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UsersController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAuth()
    {
        $user                   =   User::with('status:id,name')->findOrFail(auth::id());
        return $user->toJson();
        
    }

}
