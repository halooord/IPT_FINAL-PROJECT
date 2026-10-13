@extends('layouts.app')

@section('title', 'Add Counselor')
@section('page-heading', 'Add Counselor')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('counselors.store') }}" method="POST">
            @csrf
            @include('counselors._form')

            <button class="btn btn-primary" type="submit">Save Counselor</button>
            <a href="{{ route('counselors.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
```