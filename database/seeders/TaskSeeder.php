<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            ['name' => 'TCA Assignment', 'status' => 0, 'user_id' => 1, 'category_id' => 1, 'created_at' => '2024-12-17 05:07:43'],
            ['name' => 'Draw ERD', 'status' => 0, 'user_id' => 1, 'category_id' => 2, 'created_at' => '2024-10-15 01:07:43'],
            ['name' => 'Normalization', 'status' => 0, 'user_id' => 1, 'category_id' => 2, 'created_at' => '2024-3-17 01:07:43'],
            ['name' => 'Writing Report', 'status' => 0, 'user_id' => 1, 'category_id' => 3, 'created_at' => now()],
            ['name' => 'Coding', 'status' => 0, 'user_id' => 1, 'category_id' => 3, 'created_at' => now()],
            ['name' => 'Presentation', 'status' => 0, 'user_id' => 1, 'category_id' => 3, 'created_at' => now()],
        ]);
    }
}
