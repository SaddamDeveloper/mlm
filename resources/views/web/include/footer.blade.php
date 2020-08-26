
    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->

    <!-- footer area start -->
    <footer class="footer-widget-area">
        <div class="footer-top section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <div class="widget-title">
                                <div class="widget-logo">
                                    <a href="index.html">
                                        @php
                                            $frontend = App\Frotend::first(); 
                                        @endphp
                                        <img src="{{asset('web/img/logo/'.$frontend->logo)}}" alt="brand logo" width="100">
                                    </a>
                                </div>
                            </div>
                            <div class="widget-body">
                                <p>{{ $frontend->footer_text }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <h6 class="widget-title">Contact Us</h6>
                            <div class="widget-body">
                                <address class="contact-block">
                                    <ul>
                                        <li><i class="pe-7s-home"></i> {{ $frontend->footer_address }}</li>
                                        <li><i class="pe-7s-mail"></i> <a href="mailto:{{ $frontend->email }}">{{ $frontend->email }}</a></li>
                                        <li><i class="pe-7s-call"></i> <a href="tel:(+91){{ $frontend->mobile }}">(+91) {{ $frontend->mobile }}</a></li>
                                    </ul>
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <h6 class="widget-title">Information</h6>
                            <div class="widget-body">
                                <ul class="info-list">
                                    <li><a href="{{ route('web.about') }}">about us</a></li>
                                    <li><a href="#">Delivery Information</a></li>
                                    <li><a href="#">Privacy policy</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="{{ route('web.contact') }}">contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget-item">
                            <h6 class="widget-title">Follow Us</h6>
                            <div class="widget-body social-link">
                                <a href="{{ $frontend->fb_id }}"><i class="fa fa-facebook"></i></a>
                                <a href="{{ $frontend->tw_id }}"><i class="fa fa-twitter"></i></a>
                                <a href="{{ $frontend->insta_id }}"><i class="fa fa-instagram"></i></a>
                                <a href="{{ $frontend->yt_id }}"><i class="fa fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row align-items-center mt-20">
                    <div class="col-md-6">
                        <div class="newsletter-wrapper">
                            <h6 class="widget-title-text">Signup for newsletter</h6>
                            <form class="newsletter-inner" id="mc-form">
                                <input type="email" class="news-field" id="mc-email" autocomplete="off" placeholder="Enter your email address">
                                <button class="news-btn" id="mc-submit">Subscribe</button>
                            </form>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                            </div>
                            <!-- mailchimp-alerts end -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-payment">
                            <img src="{{asset('web/img/payment.png')}}" alt="payment method">
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copyright-text text-center">
                            <p>Powered By <a href="https://www.webinfotech.co.in">Web Infotech</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->

    <!-- Quick view modal start -->
    <div class="modal" id="quick_view">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <div class="pro-large-img img-zoom">
                                        <img src="{{asset('web/img/product/product-details-img1.jpg')}}" alt="product-details" />
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
                            <div class="col-lg-7">
                                <div class="product-details-des">
                                    <div class="manufacturer-name">
                                        <a href="product-details.html">HasTech</a>
                                    </div>
                                    <h3 class="product-name">Handmade Golden Necklace</h3>
                                    <div class="ratings d-flex">
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <span><i class="fa fa-star-o"></i></span>
                                        <div class="pro-review">
                                            <span>1 Reviews</span>
                                        </div>
                                    </div>
                                    <div class="price-box">
                                        <span class="price-regular">$70.00</span>
                                        <span class="price-old"><del>$90.00</del></span>
                                    </div>
                                    <h5 class="offer-text"><strong>Hurry up</strong>! offer ends in:</h5>
                                    <div class="product-countdown" data-countdown="2022/02/20"></div>
                                    <div class="availability">
                                        <i class="fa fa-check-circle"></i>
                                        <span>200 in stock</span>
                                    </div>
                                    <p class="pro-desc">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy
                                        eirmod tempor invidunt ut labore et dolore magna.</p>
                                    <div class="quantity-cart-box d-flex align-items-center">
                                        <h6 class="option-title">qty:</h6>
                                        <div class="quantity">
                                            <div class="pro-qty"><input type="text" value="1"></div>
                                        </div>
                                        <div class="action_link">
                                            <a class="btn btn-cart2" href="#">Add to cart</a>
                                        </div>
                                    </div>
                                    <div class="useful-links">
                                        <a href="#" data-toggle="tooltip" title="Compare"><i
                                            class="pe-7s-refresh-2"></i>compare</a>
                                        <a href="#" data-toggle="tooltip" title="Wishlist"><i
                                            class="pe-7s-like"></i>wishlist</a>
                                    </div>
                                    <div class="like-icon">
                                        <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                        <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                        <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                        <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- product details inner end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Quick view modal end -->

    <!-- offcanvas mini cart start -->
    <div class="offcanvas-minicart-wrapper">
        <div class="minicart-inner">
            <div class="offcanvas-overlay"></div>
            <div class="minicart-inner-content">
                <div class="minicart-close">
                    <i class="pe-7s-close"></i>
                </div>
                <div class="minicart-content-box">
                    <div class="minicart-item-wrapper">
                        <ul>
                            <li class="minicart-item">
                                <div class="minicart-thumb">
                                    <a href="product-details.html">
                                        <img src="{{asset('web/img/cart/cart-1.jpg')}}" alt="product">
                                    </a>
                                </div>
                                <div class="minicart-content">
                                    <h3 class="product-name">
                                        <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                    </h3>
                                    <p>
                                        <span class="cart-quantity">1 <strong>&times;</strong></span>
                                        <span class="cart-price">$100.00</span>
                                    </p>
                                </div>
                                <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                            </li>
                            <li class="minicart-item">
                                <div class="minicart-thumb">
                                    <a href="product-details.html">
                                        <img src="{{asset('web/img/cart/cart-2.jpg')}}" alt="product">
                                    </a>
                                </div>
                                <div class="minicart-content">
                                    <h3 class="product-name">
                                        <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                    </h3>
                                    <p>
                                        <span class="cart-quantity">1 <strong>&times;</strong></span>
                                        <span class="cart-price">$80.00</span>
                                    </p>
                                </div>
                                <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                            </li>
                        </ul>
                    </div>

                    <div class="minicart-pricing-box">
                        <ul>
                            <li>
                                <span>sub-total</span>
                                <span><strong>$300.00</strong></span>
                            </li>
                            <li>
                                <span>Eco Tax (-2.00)</span>
                                <span><strong>$10.00</strong></span>
                            </li>
                            <li>
                                <span>VAT (20%)</span>
                                <span><strong>$60.00</strong></span>
                            </li>
                            <li class="total">
                                <span>total</span>
                                <span><strong>$370.00</strong></span>
                            </li>
                        </ul>
                    </div>

                    <div class="minicart-button">
                        <a href="cart.html"><i class="fa fa-shopping-cart"></i> View Cart</a>
                        <a href="cart.html"><i class="fa fa-share"></i> Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offcanvas mini cart end -->

    <!-- JS
============================================ -->

    <!-- Modernizer JS -->
    <script src="{{asset('web/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <!-- jQuery JS -->
    <script src="{{asset('web/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <!-- Popper JS -->
    <script src="{{asset('web/js/vendor/popper.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('web/js/vendor/bootstrap.min.js')}}"></script>
    <!-- slick Slider JS -->
    <script src="{{asset('web/js/plugins/slick.min.js')}}"></script>
    <!-- Countdown JS -->
    <script src="{{asset('web/js/plugins/countdown.min.js')}}"></script>
    <!-- Nice Select JS -->
    <script src="{{asset('web/js/plugins/nice-select.min.js')}}"></script>
    <!-- jquery UI JS -->
    <script src="{{asset('web/js/plugins/jqueryui.min.js')}}"></script>
    <!-- Image zoom JS -->
    <script src="{{asset('web/js/plugins/image-zoom.min.js')}}"></script>
    <!-- Imagesloaded JS -->
    <script src="{{asset('web/js/plugins/imagesloaded.pkgd.min.js')}}"></script>
    <!-- Instagram feed JS -->
    <script src="{{asset('web/js/plugins/instagramfeed.min.js')}}"></script>
    <!-- mailchimp active js -->
    <script src="{{asset('web/js/plugins/ajaxchimp.js')}}"></script>
    <!-- contact form dynamic js -->
    <script src="{{asset('web/js/plugins/ajax-mail.js')}}"></script>
    <!-- google map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8"></script>
    <!-- google map active js -->
    <script src="{{asset('web/js/plugins/google-map.js')}}"></script>
    <!-- Main JS -->
    <script src="{{asset('web/js/main.js')}}"></script>
</body>


</html>