<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Transform the resource into an array.
 *
 * @return array<string, mixed>
 * @property mixed $name
 */
class TypeCategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
          'name' => $this->name,
        ];
    }
}
