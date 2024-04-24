<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Client
 *
 * @property int $total_price
 * @property string $user_id
 * @property int $id
 *
 * @property User $user
 * @property Cart[] $carts
 */
class Order extends Model
{
    protected $fillable = [
        'id',
        'total_price',
        'user_id',
        'is_paid',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class, Cart::class);
    }
//
//    public function getTotalPriceAttribute()
//    {
//        return $this->products->sum('price');
//    }
}
