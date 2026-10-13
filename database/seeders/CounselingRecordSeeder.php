<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\CounselingRecord;
use Illuminate\Database\Seeder;

class CounselingRecordSeeder extends Seeder
{
    public function run(): void
    {
        $appointments = Appointment::where('status', 'completed')
            ->whereDoesntHave('counselingRecord')
            ->get();

        foreach ($appointments as $appointment) {
            CounselingRecord::factory()->create([
                'appointment_id' => $appointment->id,
            ]);
        }
    }
}
