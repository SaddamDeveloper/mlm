@extends('web.templet.master')

@section('seo')

@endsection

@section('content')
    
    <main style="background:url('web/img/patt.jpg')">
        @if(isset($slider) && !empty($slider))
        <!-- hero slider area start -->
        <section class="slider-area">
            <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
                @foreach ($slider as $sl)
                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="{{asset('web/img/slider/'.$sl->slider_image)}}" width="1350">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-1">
                                        <h2 class="slide-title">{{$sl->banner_title}}</h2>
                                        <h4 class="slide-desc">{{$sl->banner_subtitle}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->
                @endforeach
            </div>
        </section>
        <!-- hero slider area end -->
        @endif

        @if(isset($product) && !empty($product))
        <!-- product area start -->
        <section class="product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">Our Products</h2>
                            <p class="sub-title">Best Products ever</p>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-container">

                            <!-- product tab content start -->
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1">
                                    <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                        @foreach ($product as $pr)
                                        <!-- product item start -->
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a href="{{ route('web.product.product-detail', ['id' => encrypt($pr->id)]) }}">
                                                    <img class="pri-img" src="{{asset('web/img/product/'.$pr->main_image)}}" alt="product">
                                                    <img class="sec-img" src="{{asset('web/img/product/'.$pr->main_image)}}" alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>new</span>
                                                    </div>
                                                </div>
                                                <div class="button-group">
                                                    {{-- <a href="wishlist.html" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a> --}}
                                                    {{-- <a href="compare.html" data-toggle="tooltip" data-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a> --}}
                                                    <a href="#" data-toggle="modal" data-target-id="{{ $pr->id }}" data-target="#quick_view"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                                </div>
                                                {{-- <div class="cart-hover">
                                                    <button class="btn btn-cart">add to cart</button>
                                                </div> --}}
                                            </figure>
                                            <div class="product-caption text-center">
                                                <div class="product-identity">
                                                    {{-- <p class="manufacturer-name"><a href="product-details.html">Gold</a></p> --}}
                                                </div>
                                                <h6 class="product-name">
                                                    <a href="{{ route('web.product.product-detail', ['id' => encrypt($pr->id)]) }}">{{$pr->name}}</a>
                                                </h6>
                                                <div class="price-box">
                                                    <span class="price-regular">₹{{number_format($pr->price, 2)}}</span>
                                                    <span class="price-old"><del>₹{{ number_format($pr->mrp, 2) }}</del></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product item end -->
                                        @endforeach
                                        <!-- product item end --> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- product tab content end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product area end -->
        @endif

        @if(isset($product1) && !empty($product1))
        <!-- product banner statistics area start -->
        <section class="product-banner-statistics">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="product-banner-carousel slick-row-10">
                            @foreach ($product1 as $p1)
                                <!-- banner single slide start -->
                                <div class="banner-slide-item">
                                    <figure class="banner-statistics">
                                        <a href="{{ route('web.product.product-detail', ['id' => encrypt($p1->id)]) }}">
                                            <img src="{{asset('web/img/product/'.$p1->main_image)}}" alt="product banner">
                                        </a>
                                        <div class="banner-content banner-content_style2">
                                            <h5 class="banner-text3"><a href="{{ route('web.product.product-detail', ['id' => encrypt($p1->id)]) }}">{{ $p1->name }}</a></h5>
                                        </div>
                                    </figure>
                                </div>
                                <!-- banner single slide start -->
                            @endforeach
                            <!-- banner single slide start --> 
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- product banner statistics area end -->
        @endif
        <!-- about us area start -->
        <section class="about-us section-padding">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="about-thumb">
                            <img src="{{asset('web/img/immunity.png')}}" alt="about thumb">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="about-content">
                            <h2 class="about-title">About Us</h2>
                            <h5 class="about-sub-title">
                                GLOBALDREAM LIFE E- COMMERCE PVT LTD is a India based leading company believes in natural health of people with a commitment to enrich the lives of everyone. 
                            </h5>
                            <p>Our success is mainly based on cordial relationships among distributors, partners, customers and staff members. For this our efficient and expert professionals are to be credited as their efforts have shown up in our products and gained the company a reputation in the global markets.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about us area end -->
    </main>
@endsection

@section('script') 

@endsection
