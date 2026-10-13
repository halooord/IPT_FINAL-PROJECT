@extends('layouts.app')

@section('title', 'Add Counseling Record')
@section('page-heading', 'Add Counseling Record')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('counseling-records.store') }}">
        @csrf
        @include('counseling-records._form')
        <button class="btn btn-primary" type="submit">Save Record</button>
        <a href="{{ route('counseling-records.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection
