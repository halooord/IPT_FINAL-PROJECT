<?php

namespace App\Http\Controllers;

use App\Models\CounselingRecord;
use App\Models\Referral;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReferralController extends Controller
{
    public function index()
    {
        $referrals = Referral::with('counselingRecord.appointment.student')
            ->latest('referral_date')->paginate(10);

        return view('referrals.index', compact('referrals'));
    }

    public function create()
    {
        $records = CounselingRecord::with('appointment.student')
            ->orderByDesc('session_date')->get();

        $selectedRecordId = request('counseling_record_id');

        return view('referrals.create', compact('records', 'selectedRecordId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'counseling_record_id' => 'required|exists:counseling_records,id',
            'referral_type' => 'required|string|max:100',
            'destination' => 'required|string|max:255',
            'reason' => 'required|string|max:5000',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'referral_date' => 'required|date',
        ]);

        Referral::create($validated);

        return redirect()->route('referrals.index')
            ->with('success', 'Referral created successfully.');
    }

    public function show(Referral $referral)
    {
        $referral->load('counselingRecord.appointment.student', 'counselingRecord.appointment.counselor');

        return view('referrals.show', compact('referral'));
    }

    public function edit(Referral $referral)
    {
        $records = CounselingRecord::with('appointment.student')
            ->orderByDesc('session_date')->get();

        return view('referrals.edit', compact('referral', 'records'));
    }

    public function update(Request $request, Referral $referral)
    {
        $validated = $request->validate([
            'counseling_record_id' => 'required|exists:counseling_records,id',
            'referral_type' => 'required|string|max:100',
            'destination' => 'required|string|max:255',
            'reason' => 'required|string|max:5000',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'referral_date' => 'required|date',
        ]);

        $referral->update($validated);

        return redirect()->route('referrals.index')
            ->with('success', 'Referral updated successfully.');
    }

    public function destroy(Referral $referral)
    {
        $referral->delete();

        return redirect()->route('referrals.index')
            ->with('success', 'Referral deleted successfully.');
    }
}
