<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PersonalAccessTokenController extends Controller
{
    //Создает новый персональный токен для пользователя.
    public function store(Request $request)
    {
        // Валидация данных запроса
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        // Поиск пользователя по логину
        $user = User::where('login', $request->login)->first();
        // Проверка существования пользователя и соответствия пароля
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['Нет такого пользователя.']
            ]);
        }

        // Создание и возвращение нового API токена для пользователя
        return ['token' => $user->createToken($request -> api_token)->plainTextToken];
    }

    //Удаляет указанный персональный токен пользователя.
    public function destroy(int $tokenId ,Request $request)
    {
        //$request->user()->currentAccessToken()->delete();

        // Удаление указанного персонального токена пользователя
        $request->user()->tokens()->where('id', $tokenId)->delete();
    }
}
