<?php

namespace App\Http\Resources;

use App\Http\Support\Resources\BaseJsonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $download_free
 * @property mixed $title
 * @property mixed $password
 * @property mixed $comment
 * @property mixed $price
 * @property mixed $year
 * @property mixed $type_category_id
 */
class ProductResource extends BaseJsonResource
{
    //Преобразует ресурс в массив.
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            //'image' => Storage::disk("public")->url($this->image),
            'download_free' => $this->download_free,
            'title' => $this->title,
            'comment' => $this->comment,
            'price' => $this->price,
            'year' => $this->year,
            'type_category_id' => new TypeCategoryResource($this->whenLoaded('category')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
        ];
    }
}
