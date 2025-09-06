<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // POST /login
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials','z'=> $data['password'], 'x'=> $user->password ], 401);
        }else{
           // return response()->json(['message' => 'Invalid credentials','z'=> $data['password'], 'x'=> $user->password ], 401);
        }

        // create personal access token
        $token = $user->createToken('ardy_crm_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // POST /logout (auth:sanctum)
    public function logout(Request $request)
    {
        // revoke current access token
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
