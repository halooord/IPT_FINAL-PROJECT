@extends('layouts.app')

@section('title', 'Edit Counselor')
@section('page-heading', 'Edit Counselor')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('counselors.update', $counselor) }}" method="POST">
            @csrf
            @method('PUT')
            @include('counselors._form')

            <button class="btn btn-primary" type="submit">Update Counselor</button>
            <a href="{{ route('counselors.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection