<?php

namespace Database\Seeders;

use App\Models\Counselor;
use Illuminate\Database\Seeder;

class CounselorSeeder extends Seeder
{
    public function run(): void
    {
        Counselor::factory()->count(5)->create();
    }
}
