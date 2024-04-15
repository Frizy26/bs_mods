<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property mixed $name
 * @property mixed $email
 * @property mixed $login
 * @property mixed $password
 * @property mixed $image
 * @property mixed $role_id
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'login' => $this->login,
            'password' => $this->password,
            'image' => $this->image,
            'role_id' => $this->role_id,
        ];
    }
}
