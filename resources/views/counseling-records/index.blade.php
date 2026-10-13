@extends('layouts.app')

@section('title', 'Counseling Records')
@section('page-heading', 'Counseling Records')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <div class="d-flex justify-content-between mb-3">
        <h5>Record List</h5>
        <a href="{{ route('counseling-records.create') }}" class="btn btn-primary">+ Add Record</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-primary">
                <tr><th>Session Date</th><th>Student</th><th>Counselor</th><th>Outcome</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse ($records as $record)
                    <tr>
                        <td>{{ $record->session_date->format('M d, Y') }}</td>
                        <td>{{ $record->appointment->student->first_name }} {{ $record->appointment->student->last_name }}</td>
                        <td>{{ $record->appointment->counselor->first_name }} {{ $record->appointment->counselor->last_name }}</td>
                        <td>{{ $record->outcome ?: 'Not specified' }}</td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <a href="{{ route('counseling-records.show', $record) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('counseling-records.edit', $record) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form method="POST" action="{{ route('counseling-records.destroy', $record) }}"
                                      onsubmit="return confirm('Delete this counseling record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No counseling records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $records->links() }}
</div></div>
@endsection
