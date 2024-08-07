<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'referal_agent_id'=>rand(1, 20),
            'academic_year_id'=>rand(1, 5),
            'admission_type_id'=>rand(1, 2),
            'branch_id'=>rand(1, 5),
            'semester_id'=>rand(1, 6),
            'full_name' => fake()->name(),
            'parents_name'=> fake()->name(),
            'communication_address'=>fake()->address(),
            'parmanent_address'=>fake()->address(),
            'email' => fake()->unique()->safeEmail(),
            'phone'=>fake()->PhoneNumber(),
            'student_status'=>fake()->randomElement(['Applied','Admitted','Rejected','Passout','Dropout']),
            'payment_status'=>rand(0, 1),

        ];
    }
}