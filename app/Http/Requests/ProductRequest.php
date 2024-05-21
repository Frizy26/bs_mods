<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    //Определяет правила валидации для запроса.
    public function rules()
    {
        return [
            'download_free' => ['required'],
            'title' => ['required'],
            'comment' => ['required'],
            'price' => ['required', 'numeric'],
            'year' => ['required'],
        ];
    }

    //Определяет, авторизован ли пользователь для выполнения данного запроса.
    public function authorize()
    {
        // По умолчанию разрешаем выполнение запроса
        return true;
    }
}
