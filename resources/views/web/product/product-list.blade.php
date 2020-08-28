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
                                    <li class="breadcrumb-item active" aria-current="page">Product List {{ (isset($products->category->name)) ? $products->category->name : "" }}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end sssdreamlife -->

        <!-- page main wrapper start -->
        <div class="shop-main-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <!-- sidebar area start -->
                    <div class="col-lg-2 order-1">
                        <aside class="sidebar-wrapper">
                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                                <h5 class="sidebar-title">Categories</h5>
                                <div class="sidebar-body">
                                    <ul class="shop-categories">
                                        @if (isset($categories) && !empty($categories))
                                            @foreach ($categories as $category)
                                                <li><a href="{{ route('web.category_filter', ['id' => encrypt($category->id)]) }}"> {{ $category->name }}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!-- single sidebar end -->
                        </aside>
                    </div>
                    <!-- sidebar area end -->

                    <!-- shop main wrapper start -->
                    <div class="col-lg-10 order-2">
                        <div class="shop-product-wrapper">
                            <!-- shop product top wrap start -->
                            <div class="shop-top-bar">
                                <div class="row align-items-center">
                                    {{-- <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                        <div class="top-bar-left">
                                            <div class="product-amount">                                                
                                                <h5 class="sidebar-title">Categories</h5>
                                                <p>Showing 1–16 of 21 results</p>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                        <div class="top-bar-right">
                                            <div class="product-short">
                                                <p>Sort By : </p>
                                                <select class="nice-select" name="sortby">
                                                    <option value="trending">Relevance</option>
                                                    <option value="sales">Name (A - Z)</option>
                                                    <option value="sales">Name (Z - A)</option>
                                                    <option value="rating">Price (Low &gt; High)</option>
                                                    <option value="date">Rating (Lowest)</option>
                                                    <option value="price-asc">Model (A - Z)</option>
                                                    <option value="price-asc">Model (Z - A)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- shop product top wrap start -->

                            <!-- product item list wrapper start -->
                            <div class="shop-product-wrap grid-view row mbn-30">
                                @if(isset($products) && !empty($products))
                                    @foreach ($products as $product)
                                        <!-- product single item start -->
                                        <div class="col-md-3 col-sm-6">
                                            <!-- product grid start -->
                                            <div class="product-item">
                                                <figure class="product-thumb">
                                                    <a href="{{route('web.product.product-detail', ['id' => encrypt($product->id)])}}">
                                                        <img class="pri-img" src="{{asset('web/img/product/'.$product->main_image)}}" alt="product">
                                                    </a>
                                                    <div class="cart-hover">
                                                        <button class="btn btn-cart">add to cart</button>
                                                    </div>
                                                </figure>
                                                <div class="product-caption text-center">
                                                    <h6 class="product-name">
                                                        <a href="{{route('web.product.product-detail', ['id' => encrypt($product->id)])}}">{{ $product->name }}</a>
                                                    </h6>
                                                    <div class="price-box">
                                                        <span class="price-regular">₹{{ number_format($product->mrp, 2) }}</span>
                                                        <span class="price-old"><del>₹{{ number_format($product->price, 2) }}</del></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product grid end -->
                                        </div>
                                        <!-- product single item start -->
                                    @endforeach
                                @endif

                            </div>
                            <!-- product item list wrapper end -->

                            <!-- start pagination area -->
                            <div class="paginatoin-area text-center">
                                <ul class="pagination-box">
                                   
                                  {{ $products->links() }}
                                   
                                </ul>
                            </div>
                            <!-- end pagination area -->
                        </div>
                    </div>
                    <!-- shop main wrapper end -->
                </div>
            </div>
        </div>
        <!-- page main wrapper end -->
    </main>
@endsection

@section('script') 
@endsection
