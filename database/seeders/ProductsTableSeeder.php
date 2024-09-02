<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        $now = now();

        DB::table('products')->insert([
            'name' => 'A4 Paper (500 sheet)',
            'price' => 6,
            'stock' => 1000,
            'category_id' => 1,
            'supplier_id' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('products')->insert([
            'name' => 'WaterColor Pallete Seabloom (12 colors)',
            'price' => 25,
            'stock' => 200,
            'category_id' => 2,
            'supplier_id' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
