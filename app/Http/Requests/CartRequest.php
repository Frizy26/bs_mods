<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    //Определяет правила валидации для запроса.
    public function rules()
    {
        return [

        ];
    }

    //Определяет, авторизован ли пользователь для выполнения данного запроса.
    public function authorize()
    {
        // По умолчанию разрешаем выполнение запроса
        return true;
    }
}
