
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
                        <button class="btn btn-danger pull-right" onclick="javascript:window.close()"><i class="fa fa-close"></i></button>
                         <div class="x_title">
                            <h2>{{$notice->title}}</h2>
                            <div class="clearfix"></div>
                        </div>
                    <div>
                    </div>
                        <div>
                            <div class="x_content">
                                <small>Added At: <label>{{$notice->created_at}}</label></small><br>
                                <p>{{$notice->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-2"></div> --}}
        </div>
</div>
<!-- /page content -->
@endsection



