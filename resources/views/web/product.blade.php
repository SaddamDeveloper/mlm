@extends('web.templet.master')

@section('seo')

@endsection

@section('content')
    
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Our Product</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- login register wrapper start -->
        <div class="login-register-wrapper section-padding">
            <div class="container">
                <div class="member-area-from-wrap">
                    @if (isset($product) && !empty($product))
                    <div class="product-banner-carousel slick-row-10">
                        @foreach($product as $pr)
                         <!-- banner single slide start -->
                         <div class="banner-slide-item">
                            <figure class="banner-statistics">
                                <a href="#">
                                    <img src="{{asset('web/img/product/'.$pr->main_image)}}" alt="product banner">
                                </a>
                                <div class="banner-content banner-content_style2">
                                    <h5 class="banner-text3"><a href="#">{{ $pr->name }}</a></h5>
                                </div>
                            </figure>
                        </div>
                        <!-- banner single slide start -->
                        @endforeach
                    </div>
                    <div class="text-center mx-auto">
                        {{-- {{ $product->links() }} --}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>
@endsection

@section('script') 
@endsection
