<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function details(Request $request){

        $data = User::where('token', $request->token)->value('email');;

        $status = 1;

        return compact('status', 'data');
    }
}
