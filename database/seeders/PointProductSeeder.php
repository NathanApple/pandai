<?php

namespace Database\Seeders;

use App\Models\PointProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PointProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PointProduct::insert([
            [
                'name' => '5 Points',
                'points' => 5,
                'price' => 5000,
                'availability' => 1,
                'description' => 'Basic point'
            ],
            [
                'name' => '10 Points',
                'points' => 10,
                'price' => 8000,
                'availability' => 1,
                'description' => '20% cheaper'
            ],
            [
                'name' => '20 Points',
                'points' => 20,
                'price' => 10000,
                'availability' => 1,
                'description' => '50% cheaper'
            ],
        ]);
    }
}
