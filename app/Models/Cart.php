<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Cart
 *
 * @property string $order_id
 * @property string $product_id
 * @property int $id
 */
class Cart extends Model
{
    protected $fillable = [
        'id',
        'order_id',
        'product_id',
    ];
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


}
