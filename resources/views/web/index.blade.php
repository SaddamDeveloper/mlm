@extends('web.templet.master')

@section('seo')

@endsection

@section('content')
    
    <main>
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

                {{-- <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="{{asset('web/img/slider/home1-slide3.jpg')}}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-2">
                                        <h2 class="slide-title">Diamonds Jewellery<span>Collection</span></h2>
                                        <h4 class="slide-desc">Shukra Yogam & Silver Power Silver Saving Schemes.</h4>
                                        <a href="shop.html" class="btn btn-hero">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item start -->

                <!-- single slider item start -->
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="{{asset('web/img/slider/home1-slide1.jpg')}}">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-3">
                                        <h2 class="slide-title">Grace Designer<span>Jewellery</span></h2>
                                        <h4 class="slide-desc">Rings, Occasion Pieces, Pandora & More.</h4>
                                        <a href="shop.html" class="btn btn-hero">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single slider item end --> --}}
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
                            <h2 class="title">our products</h2>
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
                                                <a href="product-details.html">
                                                    <img class="pri-img" src="{{asset('web/img/product/'.$pr->main_image)}}" alt="product">
                                                    <img class="sec-img" src="{{asset('web/img/product/'.$pr->main_image)}}" alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <div class="product-label new">
                                                        <span>new</span>
                                                    </div>
                                                    <div class="product-label discount">
                                                        <span>10%</span>
                                                    </div>
                                                </div>
                                                <div class="button-group">
                                                    {{-- <a href="wishlist.html" data-toggle="tooltip" data-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a> --}}
                                                    {{-- <a href="compare.html" data-toggle="tooltip" data-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a> --}}
                                                    <a href="#" data-toggle="modal" data-target="#quick_view"><span data-toggle="tooltip" data-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                                </div>
                                                {{-- <div class="cart-hover">
                                                    <button class="btn btn-cart">add to cart</button>
                                                </div> --}}
                                            </figure>
                                            <div class="product-caption text-center">
                                                <div class="product-identity">
                                                    {{-- <p class="manufacturer-name"><a href="product-details.html">Gold</a></p> --}}
                                                </div>
                                                {{-- <ul class="color-categories">
                                                    <li>
                                                        <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-darktan" href="#" title="Darktan"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-grey" href="#" title="Grey"></a>
                                                    </li>
                                                    <li>
                                                        <a class="c-brown" href="#" title="Brown"></a>
                                                    </li>
                                                </ul> --}}
                                                <h6 class="product-name">
                                                    <a href="product-details.html">{{$pr->name}}</a>
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
                                        <a href="#">
                                            <img src="{{asset('web/img/product/'.$p1->main_image)}}" alt="product banner">
                                        </a>
                                        <div class="banner-content banner-content_style2">
                                            <h5 class="banner-text3"><a href="#">{{ $p1->name }}</a></h5>
                                        </div>
                                    </figure>
                                </div>
                                <!-- banner single slide start -->
                            @endforeach
                            <!-- banner single slide start --> --}}
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
                            <img src="{{asset('web/img/immunity.jpeg')}}" alt="about thumb">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="about-content">
                            <h2 class="about-title">About Us</h2>
                            <h5 class="about-sub-title">
                                SSSDREAM LIFE E- COMMERCE PVT LTD is a India based leading company believes in natural health of people with a commitment to enrich the lives of everyone. 
                            </h5>
                            <p>Our success is mainly based on cordial relationships among distributors, partners, customers and staff members. For this our efficient and expert professionals are to be credited as their efforts have shown up in our products and gained the company a reputation in the global markets.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about us area end -->

        <!-- service policy area start -->
        <div class="service-policy section-padding">
            <div class="container">
                <div class="row mtn-30">
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-plane"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Free Shipping</h6>
                                <p>Free shipping all order</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-help2"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Support 24/7</h6>
                                <p>Support 24 hours a day</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-back"></i>
                            </div>
                            <div class="policy-content">
                                <h6>Money Return</h6>
                                <p>30 days for free return</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="policy-item">
                            <div class="policy-icon">
                                <i class="pe-7s-credit"></i>
                            </div>
                            <div class="policy-content">
                                <h6>100% Payment Secure</h6>
                                <p>We ensure secure payment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- service policy area end -->
    </main>
@endsection

@section('script') 
@endsection
