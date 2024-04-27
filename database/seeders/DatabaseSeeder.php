<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Заполните базу данных приложения.
     */
    public function run(): void
    {
        // Вызов сеялок для заполнения таблиц
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
            TypeCategorySeeder::class,
            ProductSeeder::class,
            CartSeeder::class,
        ]);
    }
}
