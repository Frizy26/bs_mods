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
 * @property string $image_2
 * @property string $image_3
 * @property string $image_4
 * @property string $image_5
 * @property string $download_free
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
    //Атрибуты, которые можно массово назначать.
    protected $fillable = [
        'id',
        'download_free',
        'title',
        'comment',
        'price',
        'year',
        'type_category_id',
    ];

    //Получить категорию продукта.
    public function category():BelongsTo
    {
        return $this->belongsTo(TypeCategory::class, 'type_category_id');
    }

    //Получить корзины, содержащие данный продукт.
    public function cart():HasMany
    {
        return $this->hasMany(Cart::class);
    }

    //Получить заказы, в которых содержится данный продукт.
    public function orders():BelongsToMany
    {
        return $this->belongsToMany(Order::class, Cart::class);
    }

    //Получить категорию продукта.
    public function TypeCategory():BelongsTo
    {
        return $this->belongsTo(TypeCategory::class);
    }

    public function scopePrice($query, $value)
    {
        $priceRange = explode('|', $value);
        if (count($priceRange) === 2) {
            $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
        }
    }

//    public function scopeCategoryId($query, int $cityId)
//    {
//        return $query->with('typeCategory', function ($query) use ($cityId) {
//            $query->where('type_category', $cityId);
//        })->whereRelation('typeCategory', 'type_category', $cityId);
//    }
}
