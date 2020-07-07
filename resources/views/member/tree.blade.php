
@extends('member.template.member_master')
@section('link')
  <link href="{{asset('member/build/css/T-style.css')}}" rel="stylesheet">
@endsection

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tree</h2>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="x_content" style="overflow:scroll">
                        <div class="tree" style="width:100%;left:40%;right:40%;text-align: -webkit-center;">
                            @if (isset($html) && !empty($html))
                                {!! $html !!}
                            @endif
                        </div>   

                        <div class="tree" style="width:100%;left:40%;right:40%;text-align: -webkit-center;">
                            <ul>
                                <li>        
                                    <a href="#"><img src="{{asset('admin/build/images/avatar.jpg')}}"> Member
                                        <div class="info">
                                            <h5>Name : Member</h5>
                                            <h5>Id : MM000001</h5>
                                            <h5>Rank : 0</h5>
                                        </div>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="#"><img src="{{asset('admin/build/images/avatar.jpg')}}">Saddam  Hussain
                                                <div class="info">
                                                    <h5>Name : Saddam  Hussain</h5>
                                                    <h5>Id : SH000002</h5>
                                                    <h5>Rank : 1</h5>
                                                </div>  
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="#"><img src="{{asset('admin/build/images/avatar.jpg')}}">Rabiul  Ahad
                                                        <div class="info">
                                                            <h5>Name : Rabiul  Ahad</h5>
                                                            <h5>Id : RA000004</h5>
                                                            <h5>Rank : 1</h5>
                                                        </div>  
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"><img src="{{asset('admin/build/images/avatar.jpg')}}">Rabiul  Ahad
                                                        <div class="info">
                                                            <h5>Name : Rabiul  Ahad</h5>
                                                            <h5>Id : RA000004</h5>
                                                            <h5>Rank : 1</h5>
                                                        </div>  
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#"><img src="{{asset('admin/build/images/avatar.jpg')}}">Saddam  Hussain
                                                <div class="info">
                                                    <h5>Name : Saddam  Hussain</h5>
                                                    <h5>Id : SH000002</h5>
                                                    <h5>Rank : 1</h5>
                                                </div>  
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="#"><img src="{{asset('admin/build/images/avatar.jpg')}}">Rabiul  Ahad
                                                        <div class="info">
                                                            <h5>Name : Rabiul  Ahad</h5>
                                                            <h5>Id : RA000004</h5>
                                                            <h5>Rank : 1</h5>
                                                        </div>  
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"><img src="{{asset('admin/build/images/none-avatar.jpg')}}">Empty</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    </div>
              </div>
          </div>
      </div>
    </div>

</div>
<!-- /page content -->
@endsection

@section('script')
  
@endsection

