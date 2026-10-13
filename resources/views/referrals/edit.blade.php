@extends('layouts.app')

@section('title', 'Edit Referral')
@section('page-heading', 'Edit Referral')

@section('content')
<div class="card shadow-sm"><div class="card-body">
    <form method="POST" action="{{ route('referrals.update', $referral) }}">
        @csrf
        @method('PUT')
        @include('referrals._form')
        <button class="btn btn-primary" type="submit">Update Referral</button>
        <a href="{{ route('referrals.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div></div>
@endsection
