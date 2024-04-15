<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'image',
        'title',
        'comment',
        'price',
        'year',
        'type_category_id',
    ];

    public function category():BelongsTo
    {
        return $this->belongsTo(TypeCategory::class);
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
