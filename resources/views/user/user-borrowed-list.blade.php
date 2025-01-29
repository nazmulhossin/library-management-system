@extends('layouts/user')
@section('main_content')
    <div class="user-section">
        @include('partials/user-sidebar')
    
        <section class="user-section-right">
            <h1 class="page-heading">Personal Information</h1>
        </section>
    </div>
@endsection

@push('style')
    <link href="{{ asset('user/css/user-section.min.css') }}" rel="stylesheet">
@endpush