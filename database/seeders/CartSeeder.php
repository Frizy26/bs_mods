<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('carts')->insert([
            [
                'order_id'=>'1',
                'product_id'=>'1',
            ],
        ]);
    }
}
