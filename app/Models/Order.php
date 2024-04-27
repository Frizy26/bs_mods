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
    //Атрибуты, которые можно массово назначать.
    protected $fillable = [
        'id',
        'total_price',
        'user_id',
        'is_paid',
    ];

    //Получить пользователя, связанного с заказом.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Получить корзины, связанные с заказом.
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }

    //Получить продукты, связанные с заказом через корзины.
    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class, Cart::class)->withPivot('is_paid');
    }
}
