<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fee>
 */
class FeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id'=>rand(1, 20),
            'fee_type_id'=>rand(1, 2),
            'payment_date'=>fake()->dateTimeBetween('2020-08-01','2024-07-31'),
            'amount' => fake()->numberBetween(0,49999),
        ];
    }
}
