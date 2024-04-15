<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'code' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
