<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $login
 * @property string $password
 * @property string $image
 * @property int $role_id
 *
 * @property Role $role
 * @property Order[] $orders
 * @property Favourite $favourite
 * @property mixed $favorites
 * @property mixed $favorite
 * @property mixed $createToken
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    //Атрибуты, которые можно массово назначать.
    protected $fillable = [
        'name',
        'email',
        'login',
        'password',
        'image',
        'role_id',
    ];
    //Атрибуты, которые скрыты от вывода.
    protected $hidden = [
        'password',
        'remember_token',
    ];
    //Преобразование атрибутов в нативные типы.
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Получить роль пользователя.
    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    //Получить заказы пользователя.
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    //Получить избранные продукты пользователя.
    public function favorites():BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }

    //Обработчик события создания модели.
    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($user) {
            $user->password = Hash::make($user->password);
        });

        static::updating(function ($user) {
            if ($user->isDirty('password')) {
                $user->password = Hash::make($user->password);
            }
        });
    }
}
