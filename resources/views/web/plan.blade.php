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
                                    <li class="breadcrumb-item active" aria-current="page">Plan</li>
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
                    <img src="{{asset('web/img/plan/plan1.png')}}" alt="plan">
                    <img src="{{asset('web/img/plan/plan2.png')}}" alt="plan">
                    <img src="{{asset('web/img/plan/plan3.png')}}" alt="plan">
                    <img src="{{asset('web/img/plan/plan4.png')}}" alt="plan">
                    <img src="{{asset('web/img/plan/plan5.png')}}" alt="plan">
                    <img src="{{asset('web/img/plan/plan6.png')}}" alt="plan">
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>
@endsection

@section('script') 
@endsection
