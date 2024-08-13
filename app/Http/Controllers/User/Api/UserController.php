<?php

namespace App\Http\Controllers\User\Api;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function registerUser(Request $request, User $user)
    {
        //TO-DO: validar request...
        $userData = $request->only('name', 'email', 'password');
        $userData['type_user'] = $request->type_user ?? 'common';
        $userData['password'] =  bcrypt($userData['password']);
        if(!$user = $user->create($userData))
        {
            abort(500, 'Error to create a new user...!!'); 
        }

        $token = $user->createToken('auth_token');

        return response()->json([
            'token' => $token->plainTextToken,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' =>$user->email
            ]
        ]);
    }

    public function listUserCommon()
    {
        $users = User::where('type_user', 'common')->get();
        return response()->json($users);
    }
}