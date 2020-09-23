<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SSSDREAM Life</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('web/img/favicon.ico')}}">

    <!-- CSS
	============================================ -->
	@yield('seo')
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('web/css/vendor/bootstrap.min.css')}}">
    <!-- Pe-icon-7-stroke CSS -->
    <link rel="stylesheet" href="{{asset('web/css/vendor/pe-icon-7-stroke.css')}}">
    <!-- Font-awesome CSS -->
    <link rel="stylesheet" href="{{asset('web/css/vendor/font-awesome.min.css')}}">
    <!-- Slick slider css -->
    <link rel="stylesheet" href="{{asset('web/css/plugins/slick.min.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{asset('web/css/plugins/animate.css')}}">
    <!-- Nice Select css -->
    <link rel="stylesheet" href="{{asset('web/css/plugins/nice-select.css')}}">
    <!-- jquery UI css -->
    <link rel="stylesheet" href="{{asset('web/css/plugins/jqueryui.min.css')}}">
    <!-- main style css -->
    <link rel="stylesheet" href="{{asset('web/css/style.css')}}">

</head>

<body>
    <!-- Start Header Area -->
    <header class="header-area header-wide">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">

            <!-- header middle area start -->
            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- start logo area -->
                        <div class="col-lg-2">
                            <div class="logo">
                                @php
                                    $frontend = App\Frotend::first(); 
                                @endphp
                                <a href="{{ route('web.index') }}">
                                    <img src="{{asset('web/img/logo/'.$frontend->logo)}}" alt="Brand Logo" width="100">
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- main menu area start -->
                        <div class="col-lg-10 position-static">
                            <div class="main-menu-area">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul>
                                            <li class="active"><a href="{{route('web.index')}}">Home </a></li>
                                            <li class="active"><a href="{{route('web.about')}}">About </a></li>
                                            <li><a href="#">Product <i class="fa fa-angle-down"></i></a>
                                                <ul class="dropdown">
                                                    <li><a href="{{route('web.product.product-list')}}">Our Product</a></li>
                                                </ul>
                                            </li>
											<li><a href="#">Other <i class="fa fa-angle-down"></i></a>
												<ul class="dropdown">
													<li><a href="{{route('web.legal')}}">Legal</a></li>
													<li><a href="">Certification</a></li>
													<li><a href="">Bank Details</a></li>
													<li><a href="">Grievance Cell</a></li>
													<li><a href="#" target="_blank">Grievance Redressal Policy</a></li>
												</ul>
                                            </li>
                                            <li><a href="#">Gallery <i class="fa fa-angle-down"></i></a>
                                                <ul class="dropdown">
                                                    <li><a href="{{route('web.gallery.image')}}">Image Gallery</a></li>
                                                    <li><a href="{{route('web.gallery.video')}}">Video Gallery</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{route('web.login')}}">Login</a></li>
                                            <li><a href="{{route('web.club')}}">Club</a></li>
                                            <li><a href="{{route('web.reward')}}">Reward</a></li>
                                            <li><a href="{{route('web.join')}}">Register</a></li>
                                            <li><a href="{{ route('web.contact') }}">Contact</a></li>
                                            <li><a href="{{asset('web/img/plan.pptx')}}">Plan</a></li>
                                            <li><a href="{{ route('web.video_plan')}} ">Video Plan</a></li>
                                            <li><a href="{{ route('web.rank_achiever') }}">Rank Achiever</a></li>
                                            {{-- <li><a href="{{ route('web.reward_achiever') }}">Reward Achiever</a></li> --}}
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->

        <!-- mobile header start -->
        <!-- mobile header start -->
        <div class="mobile-header d-lg-none d-md-block sticky">
            <!--mobile header top start -->
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-12">
                        <div class="mobile-main-header">
                            <div class="mobile-logo">
                                <a href="{{ route('web.index') }}">
                                    <img src="{{asset('web/img/logo/logo.jpeg')}}" alt="Brand Logo">
                                </a>
                            </div>
                            <div class="mobile-menu-toggler">
                                <button class="mobile-menu-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile header top start -->
        </div>
        <!-- mobile header end -->
        <!-- mobile header end -->

        <!-- offcanvas mobile menu start -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="pe-7s-close"></i>
                </div>

                <div class="off-canvas-inner">
                    <!-- search box start -->
                    <div class="search-box-offcanvas">
                        <form>
                            <input type="text" placeholder="Search Here...">
                            <button class="search-btn"><i class="pe-7s-search"></i></button>
                        </form>
                    </div>
                    <!-- search box end -->

                    <!-- mobile menu start -->
                    <div class="mobile-navigation">
                        {{-- <li><a href="{{route('web.login')}}">Login</a></li>
                        <li><a href="{{route('web.club')}}">Club</a></li>
                        <li><a href="{{route('web.reward')}}">Reward</a></li>
                        <li><a href="{{route('web.join')}}">Register</a></li>
                        <li><a href="{{ route('web.contact') }}">Contact</a></li>
                        <li><a href="{{asset('web/img/plan.pptx')}}">Plan</a></li>
                        <li><a href="{{ route('web.rank_achiever') }}">Rank Achiever</a></li>
                        <!-- mobile menu navigation start --> --}}
                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children"><a href="{{ route('web.index') }}">Home</a>
                                </li>
                                <li class="menu-item-has-children"><a href="{{route('web.about')}}">About</a>
                                </li>
                                <li class="menu-item-has-children "><a href="{{ route('web.product') }}">Product</a>
                                </li>
                                <li class="menu-item-has-children "><a href="{{ route('web.club') }}">Club</a>
                                </li>
                                <li class="menu-item-has-children "><a href="{{ route('web.club') }}">Plan</a>
                                <li class="menu-item-has-children "><a href="{{ route('web.rank_achiever') }}">Rank Achiever</a>
                                </li>
                                <li><a href="{{ route('web.plan') }}">Plan</a></li>
                            </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->

                    <div class="mobile-settings">
                        <ul class="nav">
                            <li>
                                <div class="dropdown mobile-top-dropdown">
                                    <a href="#" class="dropdown-toggle" id="myaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        My Account
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="myaccount">
                                        <a class="dropdown-item" href="{{ route('web.login') }}"> Login</a>
                                        <a class="dropdown-item" href="{{ route('web.join') }}">Register</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- offcanvas widget area start -->
                    <div class="offcanvas-widget-area">
                        <div class="off-canvas-contact-widget">
                            @php
                                $frontend = App\Frotend::first();
                            @endphp
                            <ul>
                                <li><i class="fa fa-mobile"></i>
                                    <a href="#">{{ $frontend->mobile }}</a>
                                </li>
                                <li><i class="fa fa-envelope-o"></i>
                                    <a href="#">{{ $frontend->email }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="off-canvas-social-widget">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-youtube-play"></i></a>
                        </div>
                    </div>
                    <!-- offcanvas widget area end -->
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
        <!-- offcanvas mobile menu end -->
    </header>