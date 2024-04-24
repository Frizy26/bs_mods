<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 *
 * @property Product $product
 * @property User $user
 */

class Favourite extends Model
{
    protected $fillable = [
        'id',
        'product_id',
        'user_id',
    ];

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user():HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
