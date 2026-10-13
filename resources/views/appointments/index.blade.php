@extends('layouts.app')

@section('title', 'Appointments')
@section('page-heading', 'Appointment Management')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Appointment List</h5>
            <a href="{{ route('appointments.create') }}" class="btn btn-primary">+ Book Appointment</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr><th>Date</th><th>Student</th><th>Counselor</th><th>Purpose</th><th>Status</th><th>Actions</th></tr>
                </thead>
                <tbody>
                    @forelse ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_date->format('M d, Y h:i A') }}</td>
                            <td>{{ $appointment->student->first_name }} {{ $appointment->student->last_name }}</td>
                            <td>{{ $appointment->counselor->first_name }} {{ $appointment->counselor->last_name }}</td>
                            <td>{{ $appointment->purpose }}</td>
                            <td>
                                <span class="status-pill status-{{ $appointment->status }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a class="btn btn-info btn-sm" href="{{ route('appointments.show', $appointment) }}">View</a>
                                    <a class="btn btn-warning btn-sm" href="{{ route('appointments.edit', $appointment) }}">Edit</a>
                                    @if (!in_array($appointment->status, ['cancelled', 'completed']))
                                        <form method="POST" action="{{ route('appointments.update', $appointment) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="student_id" value="{{ $appointment->student_id }}">
                                            <input type="hidden" name="counselor_id" value="{{ $appointment->counselor_id }}">
                                            <input type="hidden" name="appointment_date" value="{{ $appointment->appointment_date->format('Y-m-d\TH:i') }}">
                                            <input type="hidden" name="purpose" value="{{ $appointment->purpose }}">
                                            <input type="hidden" name="student_concern" value="{{ $appointment->student_concern }}">
                                            <input type="hidden" name="status" value="cancelled">
                                            <button class="btn btn-secondary btn-sm" onclick="return confirm('Cancel this appointment?')">Cancel</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No appointments found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $appointments->links() }}
    </div>
</div>
@endsection
