@extends('layouts/user')
@section('main_content')
    <!-- home section  -->
    <section class="home" id="home">
        <div class="row">
            <div class="content">
                <h3>Popular Books</h3>
                <p>Explore the popular books of the CSE Seminar Library.</p>
                <a href="#" class="btn">Borrow Now</a>
            </div>

            <div class="swiper books-slider">
                <div class="swiper-wrapper">
                    <a href="#" class="swiper-slide"><img src="{{ asset('storage/books/database-system-concepts.jpg') }}" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="{{ asset('storage/books/computer-networks.jpg') }}" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="{{ asset('storage/books/cracking-the-coding-interview.jpg') }}" alt=""></a>
                    <a href="#" class="swiper-slide"><img src="{{ asset('storage/books/introduction-to-algorithms.jpg') }}" alt=""></a>
                </div>
                <img src="{{ asset('user-view/img/stand.png') }}" class="stand" alt="">
            </div>
        </div>
    </section>

    <!-- icons section starts  -->
    <section class="icons-container">
        <div class="icons">
            <i class="fas fa-shipping-fast"></i>
            <div class="content">
                <h3>free shipping</h3>
                <p>order over $100</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-lock"></i>
            <div class="content">
                <h3>secure payment</h3>
                <p>100 secure payment</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-redo-alt"></i>
            <div class="content">
                <h3>easy returns</h3>
                <p>10 days returns</p>
            </div>
        </div>

        <div class="icons">
            <i class="fas fa-headset"></i>
            <div class="content">
                <h3>24/7 support</h3>
                <p>call us anytime</p>
            </div>
        </div>
    </section>


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

    <!-- research paper  -->
    <section class="arrivals" id="arrivals">
        <h1 class="heading"> <span>Research Paper</span> </h1>

        <div class="swiper arrivals-slider">
            <div class="swiper-wrapper">
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('storage/books/database-system-concepts.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>new arrivals</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('storage/books/computer-networks.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>new arrivals</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('storage/books/cracking-the-coding-interview.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>new arrivals</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('storage/books/introduction-to-algorithms.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>new arrivals</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="swiper arrivals-slider">
            <div class="swiper-wrapper">
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('storage/books/computer-networks.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>new arrivals</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('storage/books/cracking-the-coding-interview.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>new arrivals</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('storage/books/introduction-to-algorithms.jpg') }}" alt="">
                    </div>
                    <div class="content">
                        <h3>new arrivals</h3>
                        <div class="price">$15.99 <span>$20.99</span></div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection

@push('style')
    <link href="{{ asset('user-view/css/home.css') }}" rel="stylesheet">
@endpush