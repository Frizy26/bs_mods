<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TypeCategory extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public function Product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
