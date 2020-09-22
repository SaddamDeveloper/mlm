
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Change Member Password</h2>
                            <div class="clearfix"></div>
                        </div>
                    <div>
                         @if (Session::has('message'))
                            <div class="alert alert-success" >{{ Session::get('message') }}</div>
                         @endif
                         @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                         @endif
    
                    </div>
                        <div>
                            <div class="x_content">
                                {{ Form::open(['method' => 'post','route'=>'admin.update_member_password']) }}
                                <input type="hidden" name="id" value="{{ $member->id}}">
                                <div class="well" style="overflow: auto">
                                    <div class="form-row mb-10">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="password">Enter Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Enter Password">
                                            @if($errors->has('password'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @enderror
                                        </div>                     
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="confirm-password">Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm-password"  placeholder="Confirm Password">
                                                @if($errors->has('footer'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('footer') }}</strong>
                                                    </span>
                                                @enderror
                                        </div>                     
                                    </div>
                                </div>
                                <div class="form-group">    	            	
                                    {{ Form::submit('Change', array('class'=>'btn btn-success pull-right')) }}  
                                </div>
                                    {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
        </div>
</div>
<!-- /page content -->
@endsection
