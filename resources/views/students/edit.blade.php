
@extends('layouts.app')

@section('title', 'Edit Student')
@section('page-heading', 'Edit Student Information')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('students.update', $student) }}" method="POST">
            @csrf
            @method('PUT')

            @include('students._form', ['student' => $student])
        </form>
    </div>
</div>
@endsection
