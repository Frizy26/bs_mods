<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'image' => ['required'],
            'title' => ['required'],
            'comment' => ['required'],
            'price' => ['required', 'numeric'],
            'year' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
