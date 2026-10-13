<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CounselorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'employee_number' => fake()->unique()->numerify('EMP-#####'),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('09#########'),
            'specialization' => fake()->randomElement([
                'Academic Counseling',
                'Career Counseling',
                'Personal Counseling',
                'Family Counseling',
            ]),
            'is_active' => true,
        ];
    }
}
