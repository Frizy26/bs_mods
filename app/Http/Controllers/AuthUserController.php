<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'unique:'.User::class],
            'password' => ['required', 'string','confirmed', Password::defaults()],
        ]);

        $user = User::create ([
            'name' => $request->name,
            'login' => $request->login,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Auth::login($user);

        return response($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $credentials = $request->only('login', 'password');

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('authToken')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->noContent();
    }
}
