<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($fields);
        $token = $user->createToken('API TOKEN ' . $request->name);

        return [
            'user' => $user,
            'token' => $token
        ];
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        // IF THERE IS NO USER OR PASSWORD NOT MATCH
        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'massage' => 'credentials is uncorrect'
            ];
        }

        $token = $user->createToken('API TOKEN ' . $user->name);

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'massage' => 'You are logout'
        ];
    }
}
