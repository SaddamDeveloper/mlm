
@extends('admin.template.admin_master')
@section('link')
  <link href="{{asset('admin/build/css/T-style.css')}}" rel="stylesheet">
@endsection

@section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tree</h2>
                    <button class="btn btn-danger pull-right" onclick="javascript:window.close()"><i class="fa fa-close"></i></button>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="x_content" style="overflow:scroll">
                        <div class="tree" style="width:100%;left:40%;right:40%;text-align: -webkit-center;">
                            @if (isset($html) && !empty($html))
                                {!! $html !!}
                            @endif
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

