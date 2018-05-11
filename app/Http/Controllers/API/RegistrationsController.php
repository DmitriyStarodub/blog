<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;

class RegistrationsController extends Controller
{
    public function registration(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $status = 0;

        if ($validator->fails()) {
            $error = $validator->messages();
            return compact('status', 'error');
        }
        else{
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $data = $user->token;

            return compact('status', 'data');
        }
    }
}
