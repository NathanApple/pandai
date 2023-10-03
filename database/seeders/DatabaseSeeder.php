<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'admin',
        //     'email' => 'admin@dev.io',
        //     'role' => 'admin',
        //     'points' => 0,
        // ]);

        \App\Models\Question::factory(3)
                ->create([
                    'user_id' => 20
                ]);
        
        
        // Question::factory(3)
        //     ->create([
        //         'user_id' => 2
        //     ]);
        
    }
}
