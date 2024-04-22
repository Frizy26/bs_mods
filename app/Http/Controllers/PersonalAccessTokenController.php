<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PersonalAccessTokenController extends Controller
{
    public function store(Request $request)
    {
       $request->validate([
           'login' => 'required',
           'password' => 'required',
       ]);

       $user = User::where('login', $request->login)->first();
       if (! $user || ! Hash::check($request->password, $user->password)) {
           throw ValidationException::withMessages([
               'login' => ['Нет такого пользователя.']
           ]);
       }

       return ['token' => $user->createToken($request->device_name)->plainTextToken];
    }
}
