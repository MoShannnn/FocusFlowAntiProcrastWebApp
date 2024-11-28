<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Normal User',
                'email' => 'normaluser@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'user',
            ],
            [
                'name' => 'Mo Shan',
                'email' => 'moshan2500@gmail.com',
                'password' => Hash::make('123123123'),
                'role' => 'urser',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert(array_merge($user, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
