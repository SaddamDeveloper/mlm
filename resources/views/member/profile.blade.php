
@extends('member.template.member_master')

@section('content')

       <!-- page content -->
       <div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>{{$member->full_name}}</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                      </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="profile_img">
                      <div id="crop-avatar">
                        <!-- Current avatar -->
                        <img class="img-responsive avatar-view" src="{{$member->photo == NULL ? asset('admin/production/images/img.jpg') : asset('admin/production/images/'.$member->photo)}}" width="200" alt="Avatar" title="Change the avatar">
                      </div>
                    </div>
                    <h3>{{$member->name}}
                      @if($member->status == '1')
                        <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                      @elseif($member->status == '2')
                        <i class="fa fa-times-circle text-danger"></i>
                      @endif
                    </h3>

                    <ul class="list-unstyled user_data">
                      <li><i class="fa fa-map-marker user-profile-icon"></i> {{$member->state}}, {{$member->city}}, {{$member->pin}}
                      </li>

                      <li>
                        <i class="fa fa-briefcase user-profile-icon"></i> SILVER LEVEL
                      </li>

                      <li class="m-top-xs">
                        <i class="fa fa-external-link user-profile-icon"></i>
                        <a href="http://www.kimlabs.com/profile/" target="_blank">www.kimlabs.com</a>
                      </li>
                    </ul>

                      <a href="{{route('member.account_update')}}" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Account Update</a>
                    <br />

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->
        @endsection


