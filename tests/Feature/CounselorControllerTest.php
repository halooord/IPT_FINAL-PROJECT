<?php

namespace Tests\Feature;

use App\Models\Counselor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CounselorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_counselor_index_displays_employee_id_heading(): void
    {
        $response = $this->get(route('counselors.index'));

        $response->assertOk()
            ->assertSee('Employee ID')
            ->assertDontSee('Employee No.');
    }

    public function test_counselor_creation_rejects_non_numeric_phone(): void
    {
        $counselorData = [
            'employee_number' => 'EMP-10001',
            'first_name' => 'Casey',
            'last_name' => 'Counselor',
            'email' => 'casey.counselor@example.com',
            'phone' => '09ABC123456',
            'specialization' => 'Academic Counseling',
            'is_active' => true,
        ];

        $response = $this->post(route('counselors.store'), $counselorData);

        $response->assertSessionHasErrors([
            'phone' => 'The phone field format is invalid.',
        ]);
        $this->assertDatabaseMissing('counselors', ['email' => $counselorData['email']]);
    }

    public function test_counselor_creation_accepts_numeric_phone(): void
    {
        $counselorData = [
            'employee_number' => 'EMP-10002',
            'first_name' => 'Casey',
            'last_name' => 'Counselor',
            'email' => 'casey.counselor2@example.com',
            'phone' => '09123456789',
            'specialization' => 'Academic Counseling',
            'is_active' => true,
        ];

        $response = $this->post(route('counselors.store'), $counselorData);

        $response->assertRedirect(route('counselors.index'));
        $this->assertDatabaseHas('counselors', [
            'email' => $counselorData['email'],
            'phone' => '09123456789',
        ]);
    }

    public function test_counselor_update_rejects_non_numeric_phone(): void
    {
        $counselor = Counselor::factory()->create();
        $originalPhone = $counselor->phone;

        $response = $this->put(route('counselors.update', $counselor), [
            'employee_number' => $counselor->employee_number,
            'first_name' => $counselor->first_name,
            'last_name' => $counselor->last_name,
            'email' => $counselor->email,
            'phone' => 'abc123',
            'specialization' => $counselor->specialization,
            'is_active' => true,
        ]);

        $response->assertSessionHasErrors([
            'phone' => 'The phone field format is invalid.',
        ]);
        $this->assertDatabaseHas('counselors', [
            'id' => $counselor->id,
            'phone' => $originalPhone,
        ]);
    }
}
