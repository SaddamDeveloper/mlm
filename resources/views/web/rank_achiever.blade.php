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
                            <th scope="col">Rank</th>
                            <th scope="col">NAMES</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if(isset($rank_achiever) && !empty($rank_achiever))
                            @php
                                $count = 1;
                            @endphp
                                @foreach ($rank_achiever as $ra)
                                @if ($ra->activate_pair >= 24 && $ra->activate_pair < 50)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{ $ra->activate_pair }}</td>
                                        <td>Silver</td>
                                        <td>{{ $ra->member->full_name }}</td>
                                    </tr>
                                @endif
                                @if ($ra->activate_pair >= 50 && $ra->activate_pair < 200)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{ $ra->activate_pair }}</td>
                                        <td>Gold</td>
                                        <td>{{ $ra->member->full_name }}</td>
                                    </tr>
                                @endif
                                @if ($ra->activate_pair >= 200 && $ra->activate_pair < 500)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{ $ra->activate_pair }}</td>
                                        <td>Pearl</td>
                                        <td>{{ $ra->member->full_name }}</td>
                                    </tr>
                                @endif
                                @if ($ra->activate_pair >= 500 && $ra->activate_pair < 1000)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{ $ra->activate_pair }}</td>
                                        <td>Topaz</td>
                                        <td>{{ $ra->member->full_name }}</td>
                                    </tr>
                                @endif
                                @if ($ra->activate_pair >= 1000 && $ra->activate_pair < 1500)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{ $ra->activate_pair }}</td>
                                        <td>Ruby (All India Tour)</td>
                                        <td>{{ $ra->member->full_name }}</td>
                                    </tr>
                                @endif
                                @php
                                    $count++;
                                @endphp
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
