@extends('layouts/admin')
@section('title') Dashboard @endsection
@section('main_content')
@section('heading') Dashboard @endsection

<div>
    <i class="fa-solid fa-book"></i>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('css/admin-dashboard.min.css') }}">
@endpush