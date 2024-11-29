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
            ['name' => 'CCSM', 'user_id' => 1],
            ['name' => 'ADMS', 'user_id' => 1],
            ['name' => 'ISP', 'user_id' => 1],
        ]);
    }
}
