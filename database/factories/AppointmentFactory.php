<?php

namespace Database\Factories;

use App\Models\Counselor;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'counselor_id' => Counselor::factory(),
            'appointment_date' => fake()->dateTimeBetween('-10 days', '+30 days'),
            'purpose' => fake()->randomElement([
                'Academic Concerns',
                'Career Guidance',
                'Personal Concerns',
                'Stress Management',
            ]),
            'student_concern' => fake()->optional()->sentence(),
            'status' => 'pending',
        ];
    }
}
