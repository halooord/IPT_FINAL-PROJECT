@extends('layouts.app')

@section('title', 'Referrals')
@section('page-heading', 'Referral Management')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <div class="d-flex justify-content-between mb-3">
        <h5>Referral List</h5>
        <a href="{{ route('referrals.create') }}" class="btn btn-primary">+ Add Referral</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-primary">
                <tr><th>Date</th><th>Student</th><th>Type</th><th>Destination</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse ($referrals as $referral)
                    <tr>
                        <td>{{ $referral->referral_date->format('M d, Y') }}</td>
                        <td>{{ $referral->counselingRecord->appointment->student->first_name }}
                            {{ $referral->counselingRecord->appointment->student->last_name }}</td>
                        <td>{{ $referral->referral_type }}</td>
                        <td>{{ $referral->destination }}</td>
                        <td>
                            <span class="status-pill status-{{ $referral->status }}">
                                {{ ucwords(str_replace('_', ' ', $referral->status)) }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <a href="{{ route('referrals.show', $referral) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('referrals.edit', $referral) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form method="POST" action="{{ route('referrals.destroy', $referral) }}"
                                      onsubmit="return confirm('Delete this referral?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No referrals found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $referrals->links() }}
</div></div>
@endsection
