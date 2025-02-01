@extends('layouts/user')
@section('title') {{ $book->title }} | @endsection

@section('main_content')
    <h1>{{ $book->title }}</h1>
@endsection

@push('style')
    <link href="{{ asset('user/css/books.min.css') }}" rel="stylesheet">
@endpush