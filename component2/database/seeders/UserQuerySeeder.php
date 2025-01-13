<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserQuerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert 20 dummy records into the `user_queries` table
        for ($i = 1; $i <= 20; $i++) {
            DB::table('user_queries')->insert([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'subject' => 'Subject ' . $i,
                'message' => 'This is a test message for user ' . $i,
                'status' => rand(0, 1), // Randomly set status to 0 or 1
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
