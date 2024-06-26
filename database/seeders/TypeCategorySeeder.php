<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TypeCategorySeeder extends Seeder
{
    //Заполнение таблицы категорий
    public function run()
    {
        DB::table('type_categories')->insert([
            [
                'name' => 'Платные',
            ],
            [
                'name' => 'Бесплатные',
            ],
        ]);
    }
}
