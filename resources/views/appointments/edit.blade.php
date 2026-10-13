@extends('layouts.app')

@section('title', 'Edit Appointment')
@section('page-heading', 'Edit or Reschedule Appointment')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('appointments.update', $appointment) }}">
        @csrf
        @method('PUT')
        @include('appointments._form')
        <button class="btn btn-primary">Save Changes</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div></div>
@endsection
