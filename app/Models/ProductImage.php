<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $image
 * @property int $product_id
 *
 * @property Product $product
 */
class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = ['image', 'product_id'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function products()
    {

    }
}
