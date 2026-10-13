@extends('layouts.app')

@section('title', 'Referral Details')
@section('page-heading', 'Referral Details')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <p><strong>Student:</strong>
        {{ $referral->counselingRecord->appointment->student->first_name }}
        {{ $referral->counselingRecord->appointment->student->last_name }}
    </p>
    <p><strong>Counselor:</strong>
        {{ $referral->counselingRecord->appointment->counselor->first_name }}
        {{ $referral->counselingRecord->appointment->counselor->last_name }}
    </p>
    <p><strong>Counseling Record:</strong> #{{ $referral->counseling_record_id }}</p>
    <p><strong>Referral Type:</strong> {{ $referral->referral_type }}</p>
    <p><strong>Destination:</strong> {{ $referral->destination }}</p>
    <p><strong>Reason:</strong></p>
    <div class="border rounded p-3 mb-3">{{ $referral->reason }}</div>
    <p><strong>Referral Date:</strong> {{ $referral->referral_date->format('M d, Y') }}</p>
    <p><strong>Status:</strong> {{ ucwords(str_replace('_', ' ', $referral->status)) }}</p>

    <a href="{{ route('referrals.edit', $referral) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('referrals.index') }}" class="btn btn-secondary">Back</a>
</div></div>
@endsection
