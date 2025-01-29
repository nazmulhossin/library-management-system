@extends('layouts/user')
@section('title') Machine Learning | @endsection

@section('main_content')
    @include('partials/books-section', ['pageHeading' => 'Machine Learning'])
@endsection

@push('style')
    <link href="{{ asset('user/css/books.min.css') }}" rel="stylesheet">
@endpush