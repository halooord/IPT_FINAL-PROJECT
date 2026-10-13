<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CounselingRecordFactory extends Factory
{
    public function definition(): array
    {
        $sessionDate = fake()->dateTimeBetween('-30 days', 'now');

        return [
            'appointment_id' => Appointment::factory(),
            'session_date' => $sessionDate->format('Y-m-d'),
            'notes' => fake()->paragraph(),
            'outcome' => fake()->sentence(),
            'follow_up_date' => fake()->optional()->dateTimeBetween('now', '+30 days'),
        ];
    }
}
