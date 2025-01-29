@extends('layouts/user')
@section('title') Mathematics | @endsection

@section('main_content')
    @include('partials/books-section', ['pageHeading' => 'Mathematics'])
@endsection

@push('style')
    <link href="{{ asset('user/css/books.min.css') }}" rel="stylesheet">
@endpush