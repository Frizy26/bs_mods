<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypeCategory extends Model
{
    //Атрибуты, которые можно массово назначать.
    protected $fillable = [
        'id',
        'name',
    ];

    //Получить продукт, связанный с этим типом категории.
    public function Product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
