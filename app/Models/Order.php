<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    /**
     * Class Client
     *
     * @property string $total_price
     * @property string $user_id
     * @property int $id
     */
    protected $fillable = [
        'id',
        'total_price',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
