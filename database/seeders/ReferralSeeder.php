<?php

namespace Database\Seeders;

use App\Models\CounselingRecord;
use App\Models\Referral;
use Illuminate\Database\Seeder;

class ReferralSeeder extends Seeder
{
    public function run(): void
    {
        $records = CounselingRecord::all();

        foreach ($records as $record) {
            if (fake()->boolean(60)) {
                Referral::factory()->create([
                    'counseling_record_id' => $record->id,
                ]);
            }
        }
    }
}
