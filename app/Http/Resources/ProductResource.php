<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Models\TypeCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $image
 * @property mixed $title
 * @property mixed $password
 * @property mixed $comment
 * @property mixed $price
 * @property mixed $year
 * @property mixed $type_category_id
 */
class ProductResource extends JsonResource
{
    //Преобразует ресурс в массив.
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'title' => $this->title,
            'comment' => $this->comment,
            'price' => $this->price,
            'year' => $this->year,
            'type_category_id' => $this->type_category_id,
        ];
    }
}
