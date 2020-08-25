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
               <div class="row">
                   <div class="col-md-12">
                    <div class="section-title text-center">
                        <h2 class="title">{{ $month }} Month Dhamaka Bonanza</h2>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Sl No.</th>
                            <th scope="col">BV</th>
                            <th scope="col">REWARDS</th>
                            <th scope="col">IMAGES</th>
                            <th scope="col">NAMES</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if(isset($rank_achiever) && !empty($rank_achiever))
                            @php
                                $count = 1;
                            @endphp
                                @foreach ($rank_achiever as $ra)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$ra->target_bv}} BV Pair</td>
                                        <td>{{ $ra->prize }}</td>
                                        <td><img src="../web/img/casserol.png" width="65" alt=""></td>
                                        <td>{{ $ra->member->full_name }}</td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="5" style="text-align: center">No Data Found</td>
                            </tr>
                            @endif
                        </tbody>
                      </table>
                   </div>
               </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>
@endsection

@section('script') 
@endsection
