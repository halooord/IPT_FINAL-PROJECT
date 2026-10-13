@extends('layouts.app')

@section('title', 'Add Referral')
@section('page-heading', 'Create Referral')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('referrals.store') }}">
        @csrf
        @include('referrals._form')
        <button class="btn btn-primary" type="submit">Save Referral</button>
        <a href="{{ route('referrals.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection
