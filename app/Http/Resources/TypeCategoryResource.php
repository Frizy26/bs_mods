<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class TypeCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     * @property mixed $name
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
          'name' => $this->name,
        ];
    }
}
