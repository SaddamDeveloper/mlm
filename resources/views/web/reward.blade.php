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
                                    <li class="breadcrumb-item active" aria-current="page">Reward</li>
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
               <div class="row justify-content-center" id="reward">
                   <div class="col-md-12">
                        <div class="section-title text-center">
                            <h2 class="title">Monthly Dhamaka Bonanza</h2>
                        </div>
                   </div>
                   @if (isset($reward_achiever) && !empty($reward_achiever))
                   @foreach ($reward_achiever as $ra)
                    <div class="col-md-3 mt-5">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="web/img/user.svg" alt="">
                            <h5 class="card-title">Name: {{ $ra->member->full_name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Reward: {{ $ra->prize }}</h6>
                            </div>
                        </div>
                    </div>
                   @endforeach
                   @endif
               </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>
@endsection

@section('script') 
@endsection
