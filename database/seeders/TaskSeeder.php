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
            ['name' => 'TCA Assignment', 'status' => 0, 'user_id' => 1, 'category_id' => 1],
            ['name' => 'Draw ERD', 'status' => 0, 'user_id' => 1, 'category_id' => 2],
            ['name' => 'Normalization', 'status' => 0, 'user_id' => 1, 'category_id' => 2],
            ['name' => 'Writing Report', 'status' => 0, 'user_id' => 1, 'category_id' => 3],
            ['name' => 'Coding', 'status' => 0, 'user_id' => 1, 'category_id' => 3],
            ['name' => 'Presentation', 'status' => 0, 'user_id' => 1, 'category_id' => 3],
        ]);
    }
}
