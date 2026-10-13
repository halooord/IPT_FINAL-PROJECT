@extends('layouts.app')

@section('title', 'Students')
@section('page-heading', 'Student Management')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Student List</h5>
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                + Add Student
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Student No.</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Program</th>
                        <th>Year Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->student_number }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->program }}</td>
                            <td>{{ $student->year_level }}</td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    <a href="{{ route('students.show', $student) }}"
                                       class="btn btn-info btn-sm">View</a>

                                    <a href="{{ route('students.edit', $student) }}"
                                       class="btn btn-warning btn-sm">Edit</a>

                                    <form action="{{ route('students.destroy', $student) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this student?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                No students found. Click Add Student to get started.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $students->links() }}
    </div>
</div>
@endsection
