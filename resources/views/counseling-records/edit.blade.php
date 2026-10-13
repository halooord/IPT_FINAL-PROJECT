@extends('layouts.app')

@section('title', 'Edit Counseling Record')
@section('page-heading', 'Edit Counseling Record')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('counseling-records.update', $record) }}">
        @csrf
        @method('PUT')
        @include('counseling-records._form')
        <button class="btn btn-primary" type="submit">Update Record</button>
        <a href="{{ route('counseling-records.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection
