@extends('layouts/app')

@section('main_content')
    <div class="intro">
        <div>
            <h1>CSE Seminar Library</h1>
            <p>Welcome to the CSE Seminar Library! The CSE Seminar Library offers essential resources, including books, research papers, and e-books, to support academic growth, research, and collaboration for students, faculty, and researchers in Computer Science and Engineering.</p>
            <a href="{{route('login')}}"><span>Get Started <i class="fa-solid fa-arrow-right"></i></span></a>
        </div>

        <img src="{{asset('assets/images/system/books.png')}}" alt="books">
    </div>    
@endsection

@push('style')
    <link href="{{ asset('css/welcome.min.css') }}" rel="stylesheet">
@endpush
