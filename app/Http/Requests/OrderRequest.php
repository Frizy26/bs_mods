<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'total_price' => ['required'],
            'is_paid' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
