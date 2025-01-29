@extends('layouts/user')
@section('title') Programming Books | @endsection

@section('main_content')
    @include('partials/books-section', ['pageHeading' => 'Programming Books'])
@endsection

@push('style')
    <link href="{{ asset('user/css/books.min.css') }}" rel="stylesheet">
@endpush