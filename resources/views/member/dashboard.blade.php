
@extends('member.template.member_master')

@section('content')
        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="count">{{$user_info->login_id}}</div>
                <h3>{{$user_info->full_name}}</h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="count">{{$user_info->created_at->format('d/m/Y')}}</div>
                <h3>Joining Date</h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                <div class="count">{{$direct_member}}</div>
                <h3>Direct Member</h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                <div class="count">{{$total_left}}</div>
                <h3>Total Left</h3>
              </div>
            </div>
          </div>
          <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="count">{{$total_right}}</div>
                <h3>Total Right</h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-comments-o"></i></div>
                <div class="count">{{$left_active}}</div>
                <h3>Left BV</h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                <div class="count">{{$right_active}}</div>
                <h3>Right BV</h3>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                <div class="count">{{$pair_matching}}</div>
                <h3>Matching BV</h3>
              </div>
            </div>
          </div>
          {{-- <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="count">179</div>
                <h3>Left BV</h3>
                <p>Username</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-comments-o"></i></div>
                <div class="count">179</div>
                <h3>Right BV</h3>
                <p>Joining Date</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                <div class="count">179</div>
                <h3>Matching BV</h3>
                <p>Lorem ipsum psdea itgum rixt.</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                <div class="count">179</div>
                <h3>Matching Income</h3>
                <p>Lorem ipsum psdea itgum rixt.</p>
              </div>
            </div>
          </div>
          <div class="row top_tiles">
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="count">179</div>
                <h3>Total Income</h3>
                <p>Username</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-comments-o"></i></div>
                <div class="count">179</div>
                <h3>Available Fund</h3>
                <p>Joining Date</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                <div class="count">179</div>
                <h3>Matching BV</h3>
                <p>Lorem ipsum psdea itgum rixt.</p>
              </div>
            </div>
            <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                <div class="count">179</div>
                <h3>Matching Income</h3>
                <p>Lorem ipsum psdea itgum rixt.</p>
              </div>
            </div>
          </div> --}}
          <div class="x_content">
            <div class="well text-info">
              <h3>Important Notice</h3>
              @if(isset($notice) && !empty($notice))
                <marquee height="100px"  direction="up" scrolldelay="50" style="/*position:absolute;*/ animation: marquee 30s infinite;" loop="true" onmouseover="this.stop()" onmouseout="this.start()" > 
                  @foreach ($notice as $nt)
                    <a href="{{route('member.notice', ['id' => encrypt($nt->id)])}}" target="_blank">{!! Str::words($nt->title, 10, ' ...') !!}</a> <br>
                  @endforeach
                </marquee>
              @endif  
            </div>
        </div>
          <!-- /top tiles -->

          <br />
        </div>
        <!-- /page content -->
@endsection


