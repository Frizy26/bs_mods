<?php

namespace App\Http\Resources;

use App\Http\Support\Resources\BaseJsonResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


/**
 * @mixin Product
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
            'images' => $this->getImagesPath(),
            'type_category_id' => new TypeCategoryResource($this->whenLoaded('category')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
        ];
    }
}
