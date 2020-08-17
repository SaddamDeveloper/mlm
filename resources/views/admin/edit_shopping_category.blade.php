@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Add Shopping Category</h2>
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
                                {{ Form::open(['method' => 'post','route'=>['admin.update_shopping_category', 'id' => encrypt($category->id)]]) }}
                                <div class="well" style="overflow: auto">
                                    <div class="form-row mb-10">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="category">Category Name</label>
                                        <input type="text" class="form-control" name="category" value="{{$category->name}}" >
                                            @if($errors->has('category'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('category') }}</strong>
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


