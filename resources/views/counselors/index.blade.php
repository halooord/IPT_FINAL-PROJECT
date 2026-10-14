@extends('layouts.app')

@section('title', 'Counselors')
@section('page-heading', 'Counselor Management')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <h5>Counselor List</h5>
            <a href="{{ route('counselors.create') }}" class="btn btn-primary">
                + Add Counselor
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Specialization</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($counselors as $counselor)
                        <tr>
                            <td>{{ $counselor->employee_number }}</td>
                            <td>{{ $counselor->first_name }} {{ $counselor->last_name }}</td>
                            <td>{{ $counselor->email }}</td>
                            <td>{{ $counselor->specialization }}</td>
                            <td>
                                <span class="badge {{ $counselor->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $counselor->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="{{ route('counselors.show', $counselor) }}"
                                       class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('counselors.edit', $counselor) }}"
                                       class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('counselors.destroy', $counselor) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this counselor?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No counselors found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $counselors->links() }}
    </div>
</div>
@endsection