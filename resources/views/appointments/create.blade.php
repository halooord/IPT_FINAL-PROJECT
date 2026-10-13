@extends('layouts.app')

@section('title', 'Book Appointment')
@section('page-heading', 'Book Appointment')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf
        @include('appointments._form')
        <button class="btn btn-primary">Book Appointment</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div></div>
@endsection
