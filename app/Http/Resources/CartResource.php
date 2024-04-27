<?php

namespace App\Http\Resources;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /** @mixin Cart */

    //Преобразует ресурс в массив.
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'order' => new OrderResource($this->order), // Преобразует связанный заказ в ресурс OrderResource
            'product' => new ProductResource($this->product), // Преобразует связанный продукт в ресурс ProductResource
        ];
    }
}
