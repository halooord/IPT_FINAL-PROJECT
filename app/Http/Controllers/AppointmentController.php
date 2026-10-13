<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Counselor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['student', 'counselor'])
            ->latest('appointment_date')
            ->paginate(10);

        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $students = Student::orderBy('last_name')->get();
        $counselors = Counselor::where('is_active', true)->orderBy('last_name')->get();

        return view('appointments.create', compact('students', 'counselors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'counselor_id' => [
                'required',
                Rule::exists('counselors', 'id')->where('is_active', true),
            ],
            'appointment_date' => 'required|date',
            'purpose' => 'required|string|max:255',
            'student_concern' => 'nullable|string|max:5000',
            'status' => 'required|in:pending,approved,completed,cancelled',
        ]);

        $conflict = Appointment::where('counselor_id', $validated['counselor_id'])
            ->where('appointment_date', $validated['appointment_date'])
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($conflict) {
            return back()->withInput()
                ->withErrors(['appointment_date' => 'This counselor already has an appointment at that exact time.']);
        }

        Appointment::create($validated);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment booked successfully.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['student', 'counselor', 'counselingRecord.referrals']);

        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $students = Student::orderBy('last_name')->get();
        $counselors = Counselor::where('is_active', true)
            ->orWhere('id', $appointment->counselor_id)
            ->orderBy('last_name')
            ->get();

        return view('appointments.edit', compact('appointment', 'students', 'counselors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'counselor_id' => [
                'required',
                Rule::exists('counselors', 'id')->where(function ($query) use ($appointment) {
                    $query->where('is_active', true)
                        ->orWhere('id', $appointment->counselor_id);
                }),
            ],
            'appointment_date' => 'required|date',
            'purpose' => 'required|string|max:255',
            'student_concern' => 'nullable|string|max:5000',
            'status' => 'required|in:pending,approved,completed,cancelled',
        ]);

        $conflict = Appointment::where('counselor_id', $validated['counselor_id'])
            ->where('appointment_date', $validated['appointment_date'])
            ->whereIn('status', ['pending', 'approved'])
            ->where('id', '!=', $appointment->id)
            ->exists();

        if ($conflict && in_array($validated['status'], ['pending', 'approved'], true)) {
            return back()->withInput()
                ->withErrors(['appointment_date' => 'This counselor already has an appointment at that exact time.']);
        }

        $appointment->update($validated);

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        if ($appointment->counselingRecord()->exists()) {
            return redirect()->route('appointments.index')
                ->with('error', 'This appointment has a counseling record and cannot be deleted. You can cancel it instead.');
        }

        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
