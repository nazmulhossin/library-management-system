@extends('layouts/user')
@section('title') Search Results | @endsection

@section('main_content')
    @include('partials.books-section', ['pageHeading' => 'Search Results for "' . $query . '"'])
@endsection

@push('style')
    <link href="{{ asset('user/css/books.min.css') }}" rel="stylesheet">
@endpush