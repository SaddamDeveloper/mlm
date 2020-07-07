
@extends('member.template.member_master')

@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
           <div class="row tile_count">
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> My Commission</span>
            <div class="count">{{$my_commission}}</div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total Pair Completed</span>
              <div class="count">{{$total_pair_completed}}</div>
            </div>
            {{-- <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-ticket"></i> EPIN Available</span>
              <div class="count">{{$epin_available}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-ticket"></i> EPIN Used</span>
              <div class="count">{{$epin_used}}</div>
            </div>--}}
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-cc-visa"></i> My Wallet</span>
              <div class="count">{{$my_wallet}}</div>
            </div>
          </div>
          
        </div>
          <!-- /top tiles -->

          <br />
        </div>
        <!-- /page content -->
@endsection


