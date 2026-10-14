<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_index_displays_student_id_heading(): void
    {
        $response = $this->get(route('students.index'));

        $response->assertOk()
            ->assertSee('Student ID')
            ->assertDontSee('Student No.');
    }

    public function test_student_creation_rejects_non_numeric_phone(): void
    {
        $studentData = [
            'student_number' => '2026-10001',
            'first_name' => 'Alex',
            'last_name' => 'Student',
            'email' => 'alex.student@example.com',
            'phone' => '09ABC123456',
            'program' => 'BSIT',
            'year_level' => '1st Year',
        ];

        $response = $this->post(route('students.store'), $studentData);

        $response->assertSessionHasErrors([
            'phone' => 'The phone field format is invalid.',
        ]);
        $this->assertDatabaseMissing('students', ['email' => $studentData['email']]);
    }

    public function test_student_creation_accepts_numeric_phone(): void
    {
        $studentData = [
            'student_number' => '2026-10002',
            'first_name' => 'Alex',
            'last_name' => 'Student',
            'email' => 'alex.student2@example.com',
            'phone' => '09123456789',
            'program' => 'BSIT',
            'year_level' => '1st Year',
        ];

        $response = $this->post(route('students.store'), $studentData);

        $response->assertRedirect(route('students.index'));
        $this->assertDatabaseHas('students', [
            'email' => $studentData['email'],
            'phone' => '09123456789',
        ]);
    }

    public function test_student_update_rejects_non_numeric_phone(): void
    {
        $student = Student::factory()->create(['program' => 'BSIT']);
        $originalPhone = $student->phone;

        $response = $this->put(route('students.update', $student), [
            'student_number' => $student->student_number,
            'first_name' => $student->first_name,
            'last_name' => $student->last_name,
            'email' => $student->email,
            'phone' => 'abc123',
            'program' => 'BSIT',
            'year_level' => $student->year_level,
        ]);

        $response->assertSessionHasErrors([
            'phone' => 'The phone field format is invalid.',
        ]);
        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'phone' => $originalPhone,
        ]);
    }
}
