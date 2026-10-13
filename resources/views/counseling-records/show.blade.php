@extends('layouts.app')

@section('title', 'Counseling Record Details')
@section('page-heading', 'Counseling Record Details')

@section('content')
<div class="card shadow-sm mb-4"><div class="card-body">
    <p><strong>Student:</strong> {{ $record->appointment->student->first_name }} {{ $record->appointment->student->last_name }}</p>
    <p><strong>Counselor:</strong> {{ $record->appointment->counselor->first_name }} {{ $record->appointment->counselor->last_name }}</p>
    <p><strong>Appointment:</strong> {{ $record->appointment->appointment_date->format('M d, Y h:i A') }}</p>
    <p><strong>Session Date:</strong> {{ $record->session_date->format('M d, Y') }}</p>
    <p><strong>Notes:</strong></p>
    <div class="border rounded p-3 mb-3">{{ $record->notes }}</div>
    <p><strong>Outcome:</strong> {{ $record->outcome ?: 'Not specified' }}</p>
    <p><strong>Follow-up Date:</strong> {{ $record->follow_up_date?->format('M d, Y') ?? 'None scheduled' }}</p>

    <a href="{{ route('counseling-records.edit', $record) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('referrals.create', ['counseling_record_id' => $record->id]) }}" class="btn btn-success">Create Referral</a>
    <a href="{{ route('counseling-records.index') }}" class="btn btn-secondary">Back</a>
</div></div>

<div class="card shadow-sm"><div class="card-header">Related Referrals</div><div class="card-body">
    @forelse ($record->referrals as $referral)
        <div class="border rounded p-3 mb-2">
            <strong>{{ $referral->referral_type }}</strong> — {{ $referral->destination }}
            <div>Status: {{ ucfirst($referral->status) }}</div>
            <a href="{{ route('referrals.show', $referral) }}">View referral</a>
        </div>
    @empty
        <p class="mb-0">No referrals for this record.</p>
    @endforelse
</div></div>
@endsection
