<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    //Заполнение таблицы продукта
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'download_free' => '',
                'title' => 'MagicGun',
                'comment' => 'Gun',
                'price' => '299.49',
                'year' => '2021',
                'type_category_id' => '1',
            ],
            [
                'download_free' => '',
                'title' => 'MagicGun',
                'comment' => 'Gun',
                'price' => '990.49',
                'year' => '2022',
                'type_category_id' => '1',
            ],
            [
                'download_free' => 'https://drive.google.com/file/d/1bst_iAIPcV4MT8tpikwrjkPG5oyIOzGM/view?usp=sharing',
                'title' => 'MagicGun',
                'comment' => 'Gun',
                'price' => '0',
                'year' => '2024',
                'type_category_id' => '2',
            ],
        ]);
    }
}
