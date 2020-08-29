
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Frontend Info</h2>
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
                                {{ Form::open(['method' => 'post','route'=>'admin.store_frontend', 'enctype'=>'multipart/form-data']) }}
                                <input type="hidden" name="id" value="{{ $info->id}}">
                                <div class="well" style="overflow: auto">
                                    <div class="form-row mb-10">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="logo">Logo</label>
                                            <input type="file" class="form-control" name="logo">
                                            <div>
                                                <img src="{{ asset('web/img/logo/'.$info->logo) }}" alt="logo" width="100">
                                            </div>
                                                @if($errors->has('logo'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('logo') }}</strong>
                                                    </span>
                                                @enderror
                                        </div>                     
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="footer">Footer Text</label>
                                            <input type="text" class="form-control" name="footer" value="{{ $info->footer_text }}" placeholder="Footer Text">
                                            <div>

                                            </div>
                                                @if($errors->has('footer'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('footer') }}</strong>
                                                    </span>
                                                @enderror
                                        </div>                     
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="address">Footer Address</label>
                                            <textarea type="text" class="form-control" name="address" placeholder="Footer Address">{{ $info->footer_address }}</textarea>
                                            <div>

                                            </div>
                                                @if($errors->has('address'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                @enderror
                                        </div>                     
                                    </div>
                                    <div class="form-row mb-10">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $info->email }}" placeholder="Enter email">
                                                @if($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @enderror
                                        </div>                     
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="mobile">Phone No</label>
                                            <input type="text" class="form-control" name="mobile" value="{{ $info->mobile }}" placeholder="Mobile No">
                                            <div>

                                            </div>
                                                @if($errors->has('mobile'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('mobile') }}</strong>
                                                    </span>
                                                @enderror
                                        </div>                     
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="fb_id">FB ID (eg.https://fb.com/{name})</label>
                                                <input type="text" class="form-control" name="fb_id" value="{{ $info->fb_id }}" placeholder="fb id">
                                        </div>                     
                                    </div>
                                    <div class="form-row mb-10">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="tw_id">Twitter ID (eg.https://twitter.com/{name})</label>
                                            <input type="text" class="form-control" name="tw_id" value="{{ $info->tw_id }}" placeholder="tw id">
                                        </div>                     
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="insta_id">Insta ID (eg.https://instagram.com/{name})</label>
                                            <input type="text" class="form-control" name="insta_id" value="{{ $info->insta_id }}" placeholder="insta id">
                                        </div>                     
                                        </div>                     
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="yt_id">Youtube ID (eg.https://youtube.me/{name})</label>
                                                <input type="text" class="form-control" name="yt_id" value="{{ $info->yt_id }}" placeholder="yt id">
                                        </div>                     
                                    </div>
                                </div>

                                <div class="form-group">    	            	
                                    {{ Form::submit('Update', array('class'=>'btn btn-success pull-right')) }}  
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
