@extends('layouts.app')

@section('title', 'Student Details')
@section('page-heading', 'Student Details')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        {{ $student->first_name }} {{ $student->last_name }}
    </div>

    <div class="card-body">
        <p><strong>Student Number:</strong> {{ $student->student_number }}</p>
        <p><strong>First Name:</strong> {{ $student->first_name }}</p>
        <p><strong>Last Name:</strong> {{ $student->last_name }}</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>
        <p><strong>Phone:</strong> {{ $student->phone ?: 'Not provided' }}</p>
        <p><strong>Program:</strong> {{ $student->program }}</p>
        <p><strong>Year Level:</strong> {{ $student->year_level }}</p>

        <a href="{{ route('students.edit', $student) }}"
           class="btn btn-warning">Edit</a>

        <a href="{{ route('students.index') }}"
           class="btn btn-secondary">Back to Students</a>
    </div>
</div>
@endsection