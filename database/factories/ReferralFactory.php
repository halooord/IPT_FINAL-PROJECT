<?php

namespace Database\Factories;

use App\Models\CounselingRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReferralFactory extends Factory
{
    public function definition(): array
    {
        return [
            'counseling_record_id' => CounselingRecord::factory(),
            'referral_type' => fake()->randomElement([
                'Academic',
                'Medical',
                'Psychological',
                'Social Services',
                'Other',
            ]),
            'destination' => fake()->randomElement([
                'Academic Affairs Office',
                'School Clinic',
                'Guidance Office',
                'Student Affairs Office',
            ]),
            'reason' => fake()->sentence(),
            'status' => fake()->randomElement([
                'pending',
                'in_progress',
                'completed',
            ]),
            'referral_date' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
        ];
    }
}
