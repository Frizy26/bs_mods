<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find($product_id)
 *
 * @property int $id
 * @property string $image
 * @property string $title
 * @property string $comment
 * @property int $price
 * @property string $year
 * @property int $type_category_id
 *
 * @property TypeCategory $category
 * @property Cart[] $cart
 * @property Order[] $orders
 */
class Product extends Model
{
    protected $fillable = [
        'id',
        'image',
        'title',
        'comment',
        'price',
        'year',
        'type_category_id',
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(TypeCategory::class, 'type_category_id');
    }

    public function cart():HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function orders():BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function TypeCategory():BelongsTo
    {
        return $this->belongsTo(TypeCategory::class);
    }

}
