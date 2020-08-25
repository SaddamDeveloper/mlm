
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Edit Shopping Product</h2>
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
                                {{ Form::open(['method' => 'post','route'=>'admin.update_shopping_product', 'enctype'=>'multipart/form-data']) }}
                                    <div class="well" style="overflow: auto">
                                        <div class="form-row mb-10">
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <input type="hidden" name="product_id" class="form-control" value="{{$product->id}}">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" value="{{$product->name}}"  placeholder="Enter The Product Name">
                                                @if($errors->has('name'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>                     
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="category">Category</label>
                                                <select name="category" class="form-control">
                                                    <option value="" selected>--Select Category--</option>
                                                    @foreach ($category as $ct)
                                                        <option value="{{$product->category_id}}" {{$product->category_id == $ct->id ? 'selected' : ''}}>{{$ct->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('category'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('category') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>                     
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="main_image">Main Image</label>
                                            <input type="file" class="form-control" name="main_image">
                                            <div>
                                                <img src="{{ asset('web/img/product/thumb/'.$product->main_image) }}" alt="photo" width="100">
                                            </div>
                                                @if($errors->has('main_image'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('main_image') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>                     
                                        </div>
                                        <div class="form-row mb-10">
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="mrp">MRP</label>
                                            <input type="text" class="form-control" name="mrp" value="{{$product->mrp}}"  placeholder="Enter The Product MRP">
                                                @if($errors->has('mrp'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('mrp') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>                     
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" name="price" value="{{$product->price}}" placeholder="Enter the Product Price">
                                                @if($errors->has('price'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('price') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>                     
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="short_desc">Short Description</label>
                                                <textarea class="form-control" name="short_desc" placeholder="Enter Short Description">{{$product->short_desc}}</textarea>
                                                @if($errors->has('short_desc'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('short_desc') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>                     
                                        </div>
                                        <div class="form-row mb-10">
                                            <div class="col-md-6 col-sm-6 col-xs-6 mb-3">
                                                <label for="long_desc">Long Description</label>
                                                    <textarea class="form-control" name="long_desc" placeholder="Enter Long description">{{$product->long_desc}}</textarea>
                                                    @if($errors->has('long_desc'))
                                                        <span class="invalid-feedback" role="alert" style="color:red">
                                                            <strong>{{ $errors->first('long_desc') }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6 mb-3">
                                                <label for="section">Where to place</label>
                                                   <select name="section" id="" class="form-control">
                                                       <option value="" selected disabled>--SELECT PLACE--</option>
                                                       <option value="1" {{$product->section == "1"?'selected':''}}>Lower Section</option>
                                                       <option value="2" {{$product->section == "2"?'selected':''}}>Upper Section</option>
                                                   </select>
                                                    @if($errors->has('section'))
                                                        <span class="invalid-feedback" role="alert" style="color:red">
                                                            <strong>{{ $errors->first('section') }}</strong>
                                                        </span>
                                                    @enderror
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
                {{-- <div class="col-md-2"></div> --}}
        </div>
</div>
<!-- /page content -->
@endsection


