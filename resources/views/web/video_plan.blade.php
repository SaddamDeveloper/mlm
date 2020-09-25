@extends('web.templet.master')

@section('seo')
    <link href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.css" rel="stylesheet">
    <link href="{{asset('web/css/lightgallery.css')}}" rel="stylesheet">
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
                                    <li class="breadcrumb-item active" aria-current="page">Video Plan</li>
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
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">Video Plan</h2>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                @if (isset($video_plan) && !empty($video_plan))
                    <div class="member-area-from-wrap">
                        <div class="demo-gallery">
                            <div id="video-gallery" class="row">
                                @foreach($video_plan as $vp)
                                    <a href="https://www.youtube.com/watch?v={{$vp->youtube_id}}">
                                        <img src="{{asset('web/img/gallery/'.$vp->photo)}}" />
                                    </a>
                                @endforeach
                                {{$video_plan->links()}}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="member-area-from-wrap text-center">
                        No DATA
                    </div>
                @endif
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>
@endsection

@section('script') 
        <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
        <script>
           lightGallery(document.getElementById('video-gallery'));            
        </script>        
        <script src="{{asset('web/js/video-lg.js')}}"></script>
@endsection
