@extends('layouts.app')

@section('title', 'Appointment Details')
@section('page-heading', 'Appointment Details')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <p><strong>Student:</strong> {{ $appointment->student->first_name }} {{ $appointment->student->last_name }}</p>
    <p><strong>Counselor:</strong> {{ $appointment->counselor->first_name }} {{ $appointment->counselor->last_name }}</p>
    <p><strong>Date:</strong> {{ $appointment->appointment_date->format('M d, Y h:i A') }}</p>
    <p><strong>Purpose:</strong> {{ $appointment->purpose }}</p>
    <p><strong>Concern:</strong> {{ $appointment->student_concern ?: 'Not provided' }}</p>
    <p><strong>Status:</strong> {{ ucfirst($appointment->status) }}</p>

    @if ($appointment->counselingRecord)
        <a href="{{ route('counseling-records.show', $appointment->counselingRecord) }}" class="btn btn-info">View Counseling Record</a>
    @elseif ($appointment->status === 'completed')
        <a href="{{ route('counseling-records.create', ['appointment_id' => $appointment->id]) }}" class="btn btn-success">Create Counseling Record</a>
    @endif

    <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back</a>
</div></div>
@endsection
