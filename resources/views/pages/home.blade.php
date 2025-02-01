@extends('layouts/user')
@section('main_content')
    <!-- featured section starts  -->
    <section class="featured" id="featured">
        <h1 class="heading"> <span>Books</span> </h1>

        <div class="swiper featured-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fas fa-search"></a>
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="fas fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('storage/books/computer-networks.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>Computer Networks</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <a href="#" class="btn">Request to Borrow</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fas fa-search"></a>
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="fas fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('storage/books/cracking-the-coding-interview.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>Cracking the Coding Interview</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <a href="#" class="btn">Request to Borrow</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fas fa-search"></a>
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="fas fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('storage/books/database-system-concepts.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>Database System Concepts</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <a href="#" class="btn">Request to Borrow</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fas fa-search"></a>
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="fas fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('storage/books/introduction-to-algorithms.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>Introduction to Algorithms</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <a href="#" class="btn">Request to Borrow</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fas fa-search"></a>
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="fas fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('storage/books/numerical-python.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>Numerical Python</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <a href="#" class="btn">Request to Borrow</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fas fa-search"></a>
                        <a href="#" class="fas fa-heart"></a>
                        <a href="#" class="fas fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="{{ asset('storage/books/discrete-mathematics-and-its-applications.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>Discrete Mathematics and Its Applications</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <a href="#" class="btn">Request to Borrow</a>
                    </div>
                </div>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
@endsection

@push('style')
    <link href="{{ asset('user/css/home.css') }}" rel="stylesheet">
@endpush