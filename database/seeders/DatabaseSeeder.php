<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StudentSeeder::class,
            CounselorSeeder::class,
            AppointmentSeeder::class,
            CounselingRecordSeeder::class,
            ReferralSeeder::class,
        ]);
    }
}
