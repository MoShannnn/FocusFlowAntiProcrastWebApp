<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'CCSM', 'user_id' => 1, 'created_at' => now()],
            ['name' => 'ADMS', 'user_id' => 1, 'created_at' => '2024-10-15 01:07:43'],
            ['name' => 'ISP', 'user_id' => 1, 'created_at' => now()],
        ]);
    }
}
