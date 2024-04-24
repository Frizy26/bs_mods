<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'image' => 'Banner_1.png',
                'title' => 'MagicGun',
                'comment' => 'Gun',
                'price' => '299.49',
                'year' => '2021',
                'type_category_id' => '1',
            ],            [
                'image' => 'Banner_1.png',
                'title' => 'MagicGun',
                'comment' => 'Gun',
                'price' => '1239.49',
                'year' => '2022',
                'type_category_id' => '2',
            ],
        ]);
    }
}
