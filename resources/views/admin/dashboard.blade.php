
@extends('admin.template.admin_master')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-users"></i> Total Members</span>
              <div class="count">{{$total_members}}</div>
            </div>
           
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> Total Member Wallet Balance</span>
              <div class="count">{{$total_member_wallet_balance}}</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> Total Revenue</span>
              <div class="count">{{number_format($admin_wallet_bal, 2)}}</div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> Total TDS</span>
              <div class="count">{{number_format($admin_tds, 2)}}</div>
            </div>
          </div>
          
          <!-- /top tiles -->
          <br />
          <div class="table-responsive">
           
        </div>
        </div>
        <!-- /page content -->
        @endsection


