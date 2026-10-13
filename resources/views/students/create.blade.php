
@extends('layouts.app')

@section('title', 'Add Student')
@section('page-heading', 'Add New Student')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            @include('students._form')
        </form>
    </div>
</div>
@endsection
