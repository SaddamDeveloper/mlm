
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Add Shopping Slider</h2>
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
                                {{ Form::open(['method' => 'post','route'=>'admin.store_shopping_slider', 'enctype'=>'multipart/form-data']) }}
                                    <div class="well" style="overflow: auto">
                                        <div class="form-row mb-10">
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="slider_name">Slider Name</label>
                                                <input type="text" class="form-control" name="slider_name" value="{{old('slider_name')}}"  placeholder="Enter The Slider Name">
                                                    @if($errors->has('slider_name'))
                                                        <span class="invalid-feedback" role="alert" style="color:red">
                                                            <strong>{{ $errors->first('slider_name') }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>                     
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="slider_image">Main Image</label>
                                                <input type="file" class="form-control" name="slider_image">
                                                    @if($errors->has('slider_image'))
                                                        <span class="invalid-feedback" role="alert" style="color:red">
                                                            <strong>{{ $errors->first('slider_image') }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="offer">Offer Title</label>
                                                <input type="text" class="form-control" name="offer" placeholder="Enter Offer Title">
                                                    @if($errors->has('offer'))
                                                        <span class="invalid-feedback" role="alert" style="color:red">
                                                            <strong>{{ $errors->first('offer') }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="form-row mb-10">
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="banner_title">Banner Title</label>
                                                <input type="text" class="form-control" name="banner_title" placeholder="Enter Banner Title">
                                                    @if($errors->has('banner_title'))
                                                        <span class="invalid-feedback" role="alert" style="color:red">
                                                            <strong>{{ $errors->first('banner_title') }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="banner_subtitle">Banner Sub Title</label>
                                                <input type="text" class="form-control" name="banner_subtitle" placeholder="Enter Banner Sub Title">
                                                    @if($errors->has('banner_subtitle'))
                                                        <span class="invalid-feedback" role="alert" style="color:red">
                                                            <strong>{{ $errors->first('banner_subtitle') }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">    	            	
                                        {{ Form::submit('Add', array('class'=>'btn btn-success pull-right')) }}  
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-2"></div> --}}
        </div>
</div>
<!-- /page content -->
@endsection


