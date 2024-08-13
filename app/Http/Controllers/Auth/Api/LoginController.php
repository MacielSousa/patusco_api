<?php

namespace App\Http\Controllers\Auth\Api;

use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        //TO-DO: validar request...
        $credentials = $request->only('email', 'password');

        if(!auth()->attempt($credentials))
        {
            abort(401, 'Invalide Credential!'); 
        }

        $token = auth()->user()->createToken('auth_token');

        return response()->json([
            'token' => $token->plainTextToken,
            'user' => [
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'type_user' => auth()->user()->type_user
            ]
        ]);
    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
    }

    public function validateToken(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $personalAccessToken = PersonalAccessToken::findToken($token);

        if (!$personalAccessToken || $personalAccessToken->tokenable_id !== Auth::id()) {
            return response()->json(['error' => 'Invalid or expired token'], 401);
        }

        if ($personalAccessToken->expires_at && now()->greaterThan($personalAccessToken->expires_at)) {
            return response()->json(['error' => 'Token has expired'], 401);
        }

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => auth()->user()->id,
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'type_user' => auth()->user()->type_user
            ]
        ]);
    }

    
}

