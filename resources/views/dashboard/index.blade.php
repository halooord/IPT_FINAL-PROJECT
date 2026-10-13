@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-heading', 'A little more connected.')
@section('page-subtitle', 'A clear view of the people, conversations, and appointments in your care.')

@section('content')
<section class="dashboard-welcome">
    <p class="section-eyebrow">Your care overview</p>
    <p>Small moments of support can make a lasting difference. Here is what is happening across your school community.</p>
</section>

<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-4">
        <div class="card shadow-sm metric-card h-100">
            <div class="card-body">
                <span class="metric-label">Students in your community</span>
                <strong class="metric-value">{{ $totalStudents }}</strong>
                <a href="{{ route('students.index') }}" class="metric-link">
                    Explore students <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card shadow-sm metric-card h-100">
            <div class="card-body">
                <span class="metric-label">Here to listen</span>
                <strong class="metric-value">{{ $activeCounselors }}</strong>
                <a href="{{ route('counselors.index') }}" class="metric-link">
                    Meet the counselors <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card shadow-sm metric-card h-100">
            <div class="card-body">
                <span class="metric-label">Conversations to come</span>
                <strong class="metric-value">{{ $pendingAppointments }}</strong>
                <a href="{{ route('appointments.index') }}" class="metric-link">
                    See appointments <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-6">
        <div class="card shadow-sm metric-card h-100">
            <div class="card-body">
                <span class="metric-label">Support conversations held</span>
                <strong class="metric-value">{{ $totalRecords }}</strong>
                <a href="{{ route('counseling-records.index') }}" class="metric-link">
                    Browse records <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-6">
        <div class="card shadow-sm metric-card h-100">
            <div class="card-body">
                <span class="metric-label">Referrals needing a next step</span>
                <strong class="metric-value">{{ $pendingReferrals }}</strong>
                <a href="{{ route('referrals.index') }}" class="metric-link">
                    Follow up on referrals <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="dashboard-section-heading">
            <div>
                <p class="section-eyebrow">Coming up</p>
                <h2>Upcoming appointments</h2>
            </div>
            <a href="{{ route('appointments.index') }}" class="btn btn-outline-primary btn-sm">All appointments</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Date and Time</th>
                        <th>Student</th>
                        <th>Counselor</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($upcomingAppointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_date->format('M d, Y h:i A') }}</td>
                            <td>
                                {{ $appointment->student->first_name }}
                                {{ $appointment->student->last_name }}
                            </td>
                            <td>
                                {{ $appointment->counselor->first_name }}
                                {{ $appointment->counselor->last_name }}
                            </td>
                            <td>{{ $appointment->purpose }}</td>
                            <td>
                                <span class="status-pill status-{{ $appointment->status }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-info btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No upcoming appointments.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
