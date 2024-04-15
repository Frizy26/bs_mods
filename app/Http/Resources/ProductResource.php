<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $image
 * @property mixed $title
 * @property mixed $comment
 * @property mixed $price
 * @property mixed $year
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image' => $this->image,
            'title' => $this->title,
            'comment' => $this->comment,
            'price' => $this->price,
            'year' => $this->year,
        ];
    }
}
