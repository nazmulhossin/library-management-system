@extends('layouts/user')
@section('title') Books for EEE | @endsection

@section('main_content')
    @include('partials/books-section', ['pageHeading' => 'Books for EEE'])
@endsection

@push('style')
    <link href="{{ asset('user/css/books.min.css') }}" rel="stylesheet">
@endpush