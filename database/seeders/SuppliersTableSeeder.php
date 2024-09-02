<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        $now = now();

        DB::table('suppliers')->insert([
            'name' => 'Mary Jane',
            'contact' => '190384638',
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
