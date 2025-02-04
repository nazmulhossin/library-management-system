@extends('layouts/user')
@section('title') Books for CSE | @endsection

@section('main_content')
    @include('partials/books-section', ['pageHeading' => 'Books for CSE'])
@endsection

@push('style')
    <link href="{{ asset('user/css/books.min.css') }}" rel="stylesheet">
@endpush