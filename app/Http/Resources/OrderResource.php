<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /** @mixin Order */

    //Преобразует ресурс в массив.
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'total_price' => $this->total_price,
            'is_paid' => $this->is_paid,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->user), // Преобразует связанный продукт в ресурс UserResource
        ];
    }
}
