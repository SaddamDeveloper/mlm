
@extends('admin.template.admin_master')

@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-users"></i> Total Members</span>
              <div class="count">{{$total_members}}</div>
            </div>
           
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> Total Member Wallet Balance</span>
              <div class="count">{{$total_member_wallet_balance}}</div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> Total Revenue</span>
              <div class="count">{{number_format($admin_wallet_bal, 2)}}</div>
            </div>
          </div>
          <div class="row tile_count">
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> Total TDS</span>
              <div class="count">{{number_format($admin_tds, 2)}}</div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-users"></i> Total Fund</span>
              <div class="count">{{number_format($fund, 2)}}</div>
            </div>
          </div>
          
          <!-- /top tiles -->
          <br />
          <div class="table-responsive">
            <table class="table table-striped jambo_table bulk_action">
                <thead>
                    <tr class="headings">                
                        <th class="column-title">Sl No. </th>
                        <th class="column-title">Member ID</th>
                        <th class="column-title">Member Name</th>
                        <th class="column-title">Mobile</th>
                        <th class="column-title">Sponsor ID</th>
                        <th class="column-title">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @if(isset($latest_members) && !empty($latest_members) && count($latest_members) > 0)
                    @php
                        $count = 1;
                    @endphp

                    @foreach($latest_members as $members)
                        <tr class="even pointer">
                            <td class=" ">{{ $count++ }}</td>
                            <td><label class="label label-success">{{ $members->login_id }}</label></td>
                            <td class=" ">{{ $members->full_name }}</td>
                            <td>
                              {{ $members->mobile }}
                            </td>
                            <td>
                              {{ $members->sponsorID }}
                            </td>
                            <td>
                              @if($members->status == 1)  
                                <button class="btn btn-success">Active</button>
                              @else
                                <button class="btn btn-danger">Deactive</button>
                              @endif
                            </td>  
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5" style="text-align: center">Sorry No Data Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <a href="{{route('admin.mem_member_list')}}" class="btn btn-primary pull-right">More...</a>
        </div>
        </div>
        <!-- /page content -->
        @endsection


