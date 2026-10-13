<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\CounselingRecord;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CounselingRecordController extends Controller
{
    public function index()
    {
        $records = CounselingRecord::with(['appointment.student', 'appointment.counselor'])
            ->latest('session_date')->paginate(10);

        return view('counseling-records.index', compact('records'));
    }

    public function create()
    {
        $appointments = Appointment::with(['student', 'counselor'])
            ->where('status', 'completed')
            ->whereDoesntHave('counselingRecord')
            ->orderByDesc('appointment_date')->get();

        $selectedAppointmentId = request('appointment_id');

        return view('counseling-records.create', compact('appointments', 'selectedAppointmentId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'appointment_id' => [
                'required',
                Rule::exists('appointments', 'id')->where('status', 'completed'),
                'unique:counseling_records,appointment_id',
            ],
            'session_date' => 'required|date',
            'notes' => 'required|string|max:10000',
            'outcome' => 'nullable|string|max:5000',
            'follow_up_date' => 'nullable|date|after_or_equal:session_date',
        ]);

        CounselingRecord::create($validated);

        return redirect()->route('counseling-records.index')
            ->with('success', 'Counseling record created successfully.');
    }

    public function show(CounselingRecord $counselingRecord)
    {
        $counselingRecord->load('appointment.student', 'appointment.counselor', 'referrals');

        return view('counseling-records.show', ['record' => $counselingRecord]);
    }

    public function edit(CounselingRecord $counselingRecord)
    {
        $appointments = Appointment::with(['student', 'counselor'])
            ->where(function ($query) use ($counselingRecord) {
                $query->where('status', 'completed')
                    ->orWhere('id', $counselingRecord->appointment_id);
            })
            ->orderByDesc('appointment_date')->get();

        return view('counseling-records.edit', [
            'record' => $counselingRecord,
            'appointments' => $appointments,
        ]);
    }

    public function update(Request $request, CounselingRecord $counselingRecord)
    {
        $validated = $request->validate([
            'appointment_id' => [
                'required',
                Rule::exists('appointments', 'id')->where(function ($query) use ($counselingRecord) {
                    $query->where('status', 'completed')
                        ->orWhere('id', $counselingRecord->appointment_id);
                }),
                Rule::unique('counseling_records', 'appointment_id')->ignore($counselingRecord->id),
            ],
            'session_date' => 'required|date',
            'notes' => 'required|string|max:10000',
            'outcome' => 'nullable|string|max:5000',
            'follow_up_date' => 'nullable|date|after_or_equal:session_date',
        ]);

        $counselingRecord->update($validated);

        return redirect()->route('counseling-records.index')
            ->with('success', 'Counseling record updated successfully.');
    }

    public function destroy(CounselingRecord $counselingRecord)
    {
        if ($counselingRecord->referrals()->exists()) {
            return redirect()->route('counseling-records.index')
                ->with('error', 'Cannot delete a counseling record that has referrals.');
        }

        $counselingRecord->delete();

        return redirect()->route('counseling-records.index')
            ->with('success', 'Counseling record deleted successfully.');
    }
}
