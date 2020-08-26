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
                                    <li class="breadcrumb-item"><a href="{{ route('web.index') }}"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $product_detail->name }}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end sssdreamlife -->

        <!-- page main wrapper start -->
        <div class="shop-main-wrapper section-padding pb-0">
            <div class="container">
                <div class="row">
                    <!-- product details wrapper start -->
                    <div class="col-lg-12 order-1 order-lg-2">
                        <!-- product details inner end -->
                        <div class="product-details-inner">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="product-large-slider">
                                        <div class="pro-large-img img-zoom">
                                            <img src="{{asset('web/img/product/'.$product_detail->main_image)}}" alt="product-details" />
                                        </div>
                                        <div class="pro-large-img img-zoom">
                                            <img src="{{asset('web/img/product/product-details-img2.jpg')}}" alt="product-details" />
                                        </div>
                                        <div class="pro-large-img img-zoom">
                                            <img src="{{asset('web/img/product/product-details-img3.jpg')}}" alt="product-details" />
                                        </div>
                                        <div class="pro-large-img img-zoom">
                                            <img src="{{asset('web/img/product/product-details-img4.jpg')}}" alt="product-details" />
                                        </div>
                                        <div class="pro-large-img img-zoom">
                                            <img src="{{asset('web/img/product/product-details-img5.jpg')}}" alt="product-details" />
                                        </div>
                                    </div>
                                    <div class="pro-nav slick-row-10 slick-arrow-style">
                                        <div class="pro-nav-thumb">
                                            <img src="{{asset('web/img/product/product-details-img1.jpg')}}" alt="product-details" />
                                        </div>
                                        <div class="pro-nav-thumb">
                                            <img src="{{asset('web/img/product/product-details-img2.jpg')}}" alt="product-details" />
                                        </div>
                                        <div class="pro-nav-thumb">
                                            <img src="{{asset('web/img/product/product-details-img3.jpg')}}" alt="product-details" />
                                        </div>
                                        <div class="pro-nav-thumb">
                                            <img src="{{asset('web/img/product/product-details-img4.jpg')}}" alt="product-details" />
                                        </div>
                                        <div class="pro-nav-thumb">
                                            <img src="{{asset('web/img/product/product-details-img5.jpg')}}" alt="product-details" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="product-details-des">
                                        <div class="manufacturer-name">
                                            <a href="">SSSDREAMLIFE</a>
                                        </div>
                                        <h3 class="product-name">{{ $product_detail->name }}</h3>
                                        <div class="price-box">
                                            <span class="price-regular">₹{{ number_format($product_detail->mrp, 2) }}</span>
                                            <span class="price-old"><del>₹{{ number_format($product_detail->price, 2) }}</del></span>
                                        </div>
                                        <p class="pro-desc">{{$product_detail->long_desc}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product details inner end -->

                        <!-- product details reviews start -->
                        <div class="product-details-reviews section-padding pb-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product-review-info">
                                        <ul class="nav review-tab">
                                            <li>
                                                <a class="active" data-toggle="tab" href="#tab_one">description</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#tab_two">information</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#tab_three">reviews (1)</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content reviews-tab">
                                            <div class="tab-pane fade show active" id="tab_one">
                                                <div class="tab-one">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam
                                                        fringilla augue nec est tristique auctor. Ipsum metus feugiat
                                                        sem, quis fermentum turpis eros eget velit. Donec ac tempus
                                                        ante. Fusce ultricies massa massa. Fusce aliquam, purus eget
                                                        sagittis vulputate, sapien libero hendrerit est, sed commodo
                                                        augue nisi non neque.Cras neque metus, consequat et blandit et,
                                                        luctus a nunc. Etiam gravida vehicula tellus, in imperdiet
                                                        ligula euismod eget. Pellentesque habitant morbi tristique
                                                        senectus et netus et malesuada fames ac turpis egestas. Nam
                                                        erat mi, rutrum at sollicitudin rhoncus</p>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab_two">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>color</td>
                                                            <td>black, blue, red</td>
                                                        </tr>
                                                        <tr>
                                                            <td>size</td>
                                                            <td>L, M, S</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="tab_three">
                                                <form action="#" class="review-form">
                                                    <h5>1 review for <span>Chaz Kangeroo</span></h5>
                                                    <div class="total-reviews">
                                                        <div class="rev-avatar">
                                                            <img src="{{asset('web/img/about/avatar.jpg')}}" alt="">
                                                        </div>
                                                        <div class="review-box">
                                                            <div class="ratings">
                                                                <span class="good"><i class="fa fa-star"></i></span>
                                                                <span class="good"><i class="fa fa-star"></i></span>
                                                                <span class="good"><i class="fa fa-star"></i></span>
                                                                <span class="good"><i class="fa fa-star"></i></span>
                                                                <span><i class="fa fa-star"></i></span>
                                                            </div>
                                                            <div class="post-author">
                                                                <p><span>admin -</span> 30 Mar, 2019</p>
                                                            </div>
                                                            <p>Aliquam fringilla euismod risus ac bibendum. Sed sit
                                                                amet sem varius ante feugiat lacinia. Nunc ipsum nulla,
                                                                vulputate ut venenatis vitae, malesuada ut mi. Quisque
                                                                iaculis, dui congue placerat pretium, augue erat
                                                                accumsan lacus</p>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="col-form-label"><span class="text-danger">*</span>
                                                                Your Name</label>
                                                            <input type="text" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="col-form-label"><span class="text-danger">*</span>
                                                                Your Email</label>
                                                            <input type="email" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="col-form-label"><span class="text-danger">*</span>
                                                                Your Review</label>
                                                            <textarea class="form-control" required></textarea>
                                                            <div class="help-block pt-10"><span
                                                                    class="text-danger">Note:</span>
                                                                HTML is not translated!
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col">
                                                            <label class="col-form-label"><span class="text-danger">*</span>
                                                                Rating</label>
                                                            &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                            <input type="radio" value="1" name="rating">
                                                            &nbsp;
                                                            <input type="radio" value="2" name="rating">
                                                            &nbsp;
                                                            <input type="radio" value="3" name="rating">
                                                            &nbsp;
                                                            <input type="radio" value="4" name="rating">
                                                            &nbsp;
                                                            <input type="radio" value="5" name="rating" checked>
                                                            &nbsp;Good
                                                        </div>
                                                    </div>
                                                    <div class="buttons">
                                                        <button class="btn btn-sqr" type="submit">Continue</button>
                                                    </div>
                                                </form> <!-- end of review-form -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product details reviews end -->
                    </div>
                    <!-- product details wrapper end -->
                </div>
            </div>
        </div>
        <!-- page main wrapper end -->

        <!-- related products area start -->
        <section class="related-products section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">Related Products</h2>
                            <p class="sub-title">Add related products to weekly lineup</p>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                            @if (isset($related_product) && !empty($related_product))
                            @foreach ($related_product as $rp)
                                <!-- product item start -->
                                <div class="product-item">
                                    <figure class="product-thumb">
                                        <a href="{{ route('web.product.product-detail', ['id' => encrypt($rp->id)]) }}">
                                            <img class="pri-img" src="{{asset('web/img/product/'.$rp->main_image)}}" alt="product">
                                        </a>
                                    </figure>
                                    <div class="product-caption text-center">
                                        <h6 class="product-name">
                                            <a href="{{ route('web.product.product-detail', ['id' => encrypt($rp->id)]) }}">{{ $rp->name }}</a>
                                        </h6>
                                        <div class="price-box">
                                            <span class="price-regular">₹{{ number_format($product_detail->mrp, 2) }}</span>
                                            <span class="price-old"><del>₹{{ number_format($product_detail->mrp, 2) }}</del></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- product item end -->
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- related products area end -->
    </main>

@endsection

@section('script') 
@endsection
