
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Edit Member Info</h2>
                            <button class="btn btn-danger pull-right" onclick="javascript:window.close()"><i class="fa fa-close"></i><button>
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
                                {{ Form::open(['method' => 'post','route'=>'admin.update_member']) }}
                                <div class="well" style="overflow: auto">
                                    <input type="hidden" value="{{$fetch_member_data->id}}" name="id">
                                    <div class="form-row mb-3">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                          <label for="f_name">Name*</label>
                                          <input type="text" class="form-control" name="f_name" value="{{$fetch_member_data->full_name}}"  placeholder="Enter Name" >
                                            @if($errors->has('f_name'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('f_name') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="email">Email*</label>
                                            <input type="email" class="form-control" name="email" value="{{$fetch_member_data->email}}"  placeholder="Enter Email" >
                                            @if($errors->has('email'))
                                                  <span class="invalid-feedback" role="alert" style="color:red">
                                                      <strong>{{ $errors->first('email') }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                          <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="mobile">Mobile*</label>
                                            <input type="text" class="form-control" name="mobile" value="{{$fetch_member_data->mobile}}" placeholder="Enter Mobile No" >
                                            @if($errors->has('mobile'))
                                                  <span class="invalid-feedback" role="alert" style="color:red">
                                                      <strong>{{ $errors->first('mobile') }}</strong>
                                                  </span>
                                              @enderror
                                          </div> 
                                    </div>
        
                                    <div class="form-row mb-3">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="dob">DOB</label>
                                            <input type="text" name="dob" value="{{$fetch_member_data->dob}}" class="form-control"/>
                                            @if($errors->has('dob'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('dob') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="well" style="overflow: auto">
                                    <div class="form-row mb-3">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                          <label for="pan">PAN*</label>
                                          <input type="text" class="form-control" name="pan" value="{{$fetch_member_data->pan}}"  placeholder="Enter PAN" >
                                            @if($errors->has('pan'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('pan') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                          <label for="aadhar">Aadhar*</label>
                                          <input type="text" class="form-control" name="aadhar" value="{{$fetch_member_data->aadhar}}"  placeholder="Enter Aadhar" >
                                            @if($errors->has('aadhar'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('aadhar') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                          <label for="address">Address*</label>
                                          <textarea class="form-control" name="address">{{$fetch_member_data->address}}</textarea>
                                            @if($errors->has('address'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                          <label for="n_adress">Bank Name*</label>
                                            <textarea name="bank_name" class="form-control" placeholder="Enter Bank Name">{{$fetch_member_data->bank_name}}</textarea>
                                          @if($errors->has('bank_name'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('bank_name') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row mb-3">
                                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="ac_holder_name">Account Holder Name*</label>
                                            <input type="text" class="form-control" name="ac_holder_name" value="{{$fetch_member_data->ac_holder_name}}">
                                            @if($errors->has('ac_holder_name'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('ac_holder_name') }}</strong>
                                                </span>
                                              @enderror
                                          </div> 
                                          <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="ifsc">IFSC*</label>
                                            <input type="text" class="form-control" name="ifsc" value="{{$fetch_member_data->ifsc}}">
                                            @if($errors->has('ifsc'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('ifsc') }}</strong>
                                                </span>
                                              @enderror
                                            </div>
                                          <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="account_no">Account No*</label>
                                            <input type="text" class="form-control" name="account_no" value="{{$fetch_member_data->account_no}}" placeholder="Enter Account No">
                                            @if($errors->has('account_no'))
                                                  <span class="invalid-feedback" role="alert" style="color:red">
                                                      <strong>{{ $errors->first('account_no') }}</strong>
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
        </div>
</div>
<!-- /page content -->
@endsection





