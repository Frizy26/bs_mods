<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //Атрибуты, которые можно массово назначать.
    protected $fillable = [
        'name',
        'code',
    ];
}
