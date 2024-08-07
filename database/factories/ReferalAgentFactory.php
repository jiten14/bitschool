<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReferalAgent>
 */
class ReferalAgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'postal_address'=>fake()->address(),
            'email' => fake()->unique()->safeEmail(),
            'phone'=>fake()->PhoneNumber(),
        ];
    }
}
