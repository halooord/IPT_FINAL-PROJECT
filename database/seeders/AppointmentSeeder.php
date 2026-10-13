<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Counselor;
use App\Models\Student;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $studentIds = Student::pluck('id')->all();
        $counselorIds = Counselor::where('is_active', true)->pluck('id')->all();

        if (empty($studentIds) || empty($counselorIds)) {
            return;
        }

        foreach (range(1, 15) as $i) {
            Appointment::factory()->create([
                'student_id' => fake()->randomElement($studentIds),
                'counselor_id' => fake()->randomElement($counselorIds),
                'appointment_date' => $i <= 5
                    ? now()->subDays($i)->setTime(9, 0)
                    : now()->addDays($i)->setTime(9, 0),
                'status' => $i <= 5
                    ? 'completed'
                    : fake()->randomElement(['pending', 'approved', 'cancelled']),
            ]);
        }
    }
}
