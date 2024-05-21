<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;


/**
 * @mixin User
 */
class UserResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */

    //Преобразует ресурс в массив.
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'login' => $this->login,
            'password' => $this->password,
            'image' => Storage::disk("public")->url($this->image),
            'role_id' => $this->role_id,
        ];
    }
}
