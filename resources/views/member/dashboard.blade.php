
@extends('member.template.member_master')

@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-rupee"></i> My Commission</span>
            <div class="count">7867</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total Pair Completed</span>
              <div class="count">7867</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-ticket"></i> EPIN Available</span>
              <div class="count">7867</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-ticket"></i> EPIN Used</span>
              <div class="count">7867</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-cc-visa"></i> My Wallet</span>
              <div class="count">7867</div>
            </div>
          </div>
          <div class="x_content">
            <div class="well text-info">
              <h3>Important Notice</h3>
              
            </div>
            <div class="table-responsive">
              <table class="table table-striped jambo_table bulk_action">
                  <thead>
                      <tr class="headings">                
                          <th class="column-title">Sl No. </th>
                          <th class="column-title">EPIN</th>
                          <th class="column-title">Status</th>
                          <th class="column-title">Alloted To</th>
                          <th class="column-title">Used By</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
          </div>
        </div>
          <!-- /top tiles -->

          <br />
        </div>
        <!-- /page content -->
@endsection


