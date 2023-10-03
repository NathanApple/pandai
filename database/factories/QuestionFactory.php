<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Question::class;

    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence(10),
            'refundPoints' => $this->faker->numberBetween(5, 10),
            'points' => $this->faker->numberBetween(1, 5),
        ];
    }
}
