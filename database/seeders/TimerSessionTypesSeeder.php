<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TimerSessionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('timer_session_types')->insert([
            ['name' => 'Pomodoro'],
            ['name' => 'Short Break'],
            ['name' => 'Long Break'],
        ]);
    }
}
