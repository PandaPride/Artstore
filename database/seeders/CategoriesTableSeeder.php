<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        $now = now();
        DB::table('categories')->insert([
            'name' => 'Paper',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('categories')->insert([
            'name' => 'Paint',
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
