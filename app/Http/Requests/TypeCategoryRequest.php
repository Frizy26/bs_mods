<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeCategoryRequest extends FormRequest
{
    //Определяет правила валидации для запроса.
    public function rules()
    {
        return [
            'name' => ['required'],
        ];
    }

    //Определяет, авторизован ли пользователь для выполнения данного запроса.
    public function authorize()
    {
        // По умолчанию разрешаем выполнение запроса
        return true;
    }
}
