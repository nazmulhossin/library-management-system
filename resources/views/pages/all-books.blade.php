@extends('layouts/user')
@section('title') All Books | @endsection

@section('main_content')
    @include('partials/books-section', ['pageHeading' => 'All Books'])
@endsection

@push('style')
    <link href="{{ asset('user/css/books.min.css') }}" rel="stylesheet">
@endpush