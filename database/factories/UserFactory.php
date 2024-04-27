<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */

//Фабрика для создания записей в таблице пользователей.
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(), // Генерация случайного имени
            'email' => fake()->unique()->safeEmail(), // Генерация уникального безопасного email
            'email_verified_at' => now(),  // Установка текущего времени для подтверждения email
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password  Установка фиксированного пароля
            'remember_token' => Str::random(10), // Генерация случайного токена для "запомнить меня"
        ];
    }

    /**
     * Укажите, что адрес электронной почты модели не должен быть подтвержден.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null, // Установка значения null для подтверждения email
        ]);
    }
}
