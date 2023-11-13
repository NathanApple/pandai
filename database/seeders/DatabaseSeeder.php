<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(5)->create();

        foreach ($users as $user) {
            $questions = Question::factory(3)->create([
                'user_id' => $user->id
            ]);
        }

        // Question::factory(3)
        //     ->create([
        //         'user_id' => 2
        //     ]);

        $this->call([
            AdminSeeder::class,
            PointProductSeeder::class,
        ]);
    }
}
