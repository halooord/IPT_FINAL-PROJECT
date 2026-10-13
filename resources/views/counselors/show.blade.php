@extends('layouts.app')

@section('title', 'Counselor Details')
@section('page-heading', 'Counselor Details')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <p><strong>Employee Number:</strong> {{ $counselor->employee_number }}</p>
        <p><strong>Name:</strong> {{ $counselor->first_name }} {{ $counselor->last_name }}</p>
        <p><strong>Email:</strong> {{ $counselor->email }}</p>
        <p><strong>Phone:</strong> {{ $counselor->phone ?: 'Not provided' }}</p>
        <p><strong>Specialization:</strong> {{ $counselor->specialization }}</p>
        <p><strong>Status:</strong> {{ $counselor->is_active ? 'Active' : 'Inactive' }}</p>

        <a href="{{ route('counselors.edit', $counselor) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('counselors.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header">Counselor's Appointments</div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr><th>Date</th><th>Student</th><th>Purpose</th><th>Status</th></tr>
            </thead>
            <tbody>
                @forelse ($counselor->appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->appointment_date }}</td>
                        <td>{{ $appointment->student->first_name }} {{ $appointment->student->last_name }}</td>
                        <td>{{ $appointment->purpose }}</td>
                        <td>{{ ucfirst($appointment->status) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">No appointments yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection