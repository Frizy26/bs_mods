<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    //Определяет правила валидации для запроса.
    public function rules()
    {
        return [
            'total_price' => ['required'],
            'is_paid' => ['required'],
        ];
    }

    public function authorize()
    {
        // По умолчанию разрешаем выполнение запроса
        return true;
    }
}
