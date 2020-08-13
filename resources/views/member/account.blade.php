
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
<div class="">
    <div class="clearfix"></div>
    @if (Session::has('message'))
    <div class="alert alert-success" >{{ Session::get('message') }}</div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
        <div class="x_title">
            <h2>Account Update</h2>
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
            {{ Form::open(['method' => 'post','route'=>'member.update_member', 'enctype'=>'multipart/form-data']) }}
            <div class="well" style="overflow: auto">
                <div class="form-row mb-10 mb-2">
                    <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                        <label for="member_id"> Member ID</label>
                        <input type="text" name="member_id" value="{{$member->login_id}}" class="form-control" disabled required>
                    </div>
                    <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                        <label for="member_name"> Member Name </label>
                        <input type="text" name="member_name" value="{{$member->full_name}}" class="form-control">
                    </div> 
                </div>
                <div class="form-row mb-10 mb-2">
                    <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                        <label for="mobile"> Mobile No </label>
                        <input type="text" name="mobile" value="{{$member->mobile}}" class="form-control">
                    </div>
                    <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                        <label for="email"> Email </label>
                        <input type="email" name="email" value="{{$member->email}}" class="form-control">
                        @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert" style="color:red">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mb-10 mb-2">
                    <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                        <label for="dob">DOB</label>
                        <input type="text" name="dob" value="{{$member->dob}}" class="form-control">
                        @if($errors->has('dob'))
                            <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('dob') }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                        <label for="pan">PAN*</label>
                        <input type="text" name="pan" id="pan" value="{{$member->pan}}" class="form-control">
                        @if($errors->has('pan'))
                            <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('pan') }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row mb-10 mb-2">
                    <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                        <label for="aadhar">Aadhar</label>
                        <input type="text" name="aadhar" value="{{$member->aadhar}}" class="form-control">
                        @if($errors->has('aadhar'))
                            <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('aadhar') }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 mx-auto col-sm-12 col-xs-12 mb-3">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" class="form-control">{{$member->address}}</textarea>
                        @if($errors->has('address'))
                            <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-row mb-3">
                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="bank">Select Bank</label>
                            <select name="bank" id="bank" class="form-control">
                                <option value="" disabled="" selected="">--SELECT BANK--</option>
                                <option value="Allahabad Bank">Allahabad Bank</option>
                                <option value="Andhra Bank">Andhra Bank</option>
                                <option value="Axis Bank">Axis Bank</option>
                                <option value="Bank of Bahrain and Kuwait">Bank of Bahrain and Kuwait</option>
                                <option value="Bank of Baroda - Corporate Banking">Bank of Baroda - Corporate Banking</option>
                                <option value="Bank of Baroda - Retail Banking">Bank of Baroda - Retail Banking</option>
                                <option value="Bank of India">Bank of India</option>
                                <option value="Bank of Maharashtra">Bank of Maharashtra</option>
                                <option value="Canara Bank">Canara Bank</option>
                                <option value="Central Bank of India">Central Bank of India</option>
                                <option value="City Union Bank">City Union Bank</option>
                                <option value="Corporation Bank">Corporation Bank</option>
                                <option value="Deutsche Bank">Deutsche Bank</option>
                                <option value="Development Credit Bank">Development Credit Bank</option>
                                <option value="Dhanlaxmi Bank">Dhanlaxmi Bank</option>
                                <option value="Federal Bank">Federal Bank</option>
                                <option value="ICICI Bank">ICICI Bank</option>
                                <option value="IDBI Bank">IDBI Bank</option>
                                <option value="Indian Bank">Indian Bank</option>
                                <option value="Indian Overseas Bank">Indian Overseas Bank</option>
                                <option value="IndusInd Bank">IndusInd Bank</option>
                                <option value="ING Vysya Bank">ING Vysya Bank</option>
                                <option value="Jammu and Kashmir Bank">Jammu and Kashmir Bank</option>
                                <option value="Karnataka Bank Ltd">Karnataka Bank Ltd</option>
                                <option value="Karur Vysya Bank">Karur Vysya Bank</option>
                                <option value="Kotak Bank">Kotak Bank</option>
                                <option value="Laxmi Vilas Bank">Laxmi Vilas Bank</option>
                                <option value="Oriental Bank of Commerce">Oriental Bank of Commerce</option>
                                <option value="Punjab National Bank - Corporate Banking">Punjab National Bank - Corporate Banking</option>
                                <option value="Punjab National Bank - Retail Banking">Punjab National Bank - Retail Banking</option>
                                <option value="Punjab &amp; Sind Bank">Punjab &amp; Sind Bank</option>
                                <option value="Shamrao Vitthal Co-operative Bank">Shamrao Vitthal Co-operative Bank</option>
                                <option value="South Indian Bank">South Indian Bank</option>
                                <option value="State Bank of Bikaner &amp; Jaipur">State Bank of Bikaner &amp; Jaipur</option>
                                <option value="State Bank of Hyderabad">State Bank of Hyderabad</option>
                                <option value="State Bank of India">State Bank of India</option>
                                <option value="State Bank of Mysore">State Bank of Mysore</option>
                                <option value="State Bank of Patiala">State Bank of Patiala</option>
                                <option value="State Bank of Travancore">State Bank of Travancore</option>
                                <option value="Syndicate Bank">Syndicate Bank</option>
                                <option value="Tamilnad Mercantile Bank Ltd.">Tamilnad Mercantile Bank Ltd.</option>
                                <option value="UCO Bank">UCO Bank</option>
                                <option value="Union Bank of India">Union Bank of India</option>
                                <option value="United Bank of India">United Bank of India</option>
                                <option value="Vijaya Bank">Vijaya Bank</option>
                                <option value="Yes Bank Ltd">Yes Bank Ltd</option>
                                <option value="HDFC">HDFC</option>
                                <option value="Allahabad Bank">Allahabad Bank</option>
                                <option value="Andhra Bank">Andhra Bank</option>
                                <option value="Axis Bank">Axis Bank</option>
                                <option value="Bank of Bahrain and Kuwait">Bank of Bahrain and Kuwait</option>
                                <option value="Bank of Baroda - Corporate Banking">Bank of Baroda - Corporate Banking</option>
                                <option value="Bank of Baroda - Retail Banking">Bank of Baroda - Retail Banking</option>
                                <option value="Bank of India">Bank of India</option>
                                <option value="Bank of Maharashtra">Bank of Maharashtra</option>
                                <option value="Canara Bank">Canara Bank</option>
                                <option value="Central Bank of India">Central Bank of India</option>
                                <option value="City Union Bank">City Union Bank</option>
                                <option value="Corporation Bank">Corporation Bank</option>
                                <option value="Deutsche Bank">Deutsche Bank</option>
                                <option value="Development Credit Bank">Development Credit Bank</option>
                                <option value="Dhanlaxmi Bank">Dhanlaxmi Bank</option>
                                <option value="Federal Bank">Federal Bank</option>
                                <option value="ICICI Bank">ICICI Bank</option>
                                <option value="IDBI Bank">IDBI Bank</option>
                                <option value="Indian Bank">Indian Bank</option>
                                <option value="Indian Overseas Bank">Indian Overseas Bank</option>
                                <option value="IndusInd Bank">IndusInd Bank</option>
                                <option value="ING Vysya Bank">ING Vysya Bank</option>
                                <option value="Jammu and Kashmir Bank">Jammu and Kashmir Bank</option>
                                <option value="Karnataka Bank Ltd">Karnataka Bank Ltd</option>
                                <option value="Karur Vysya Bank">Karur Vysya Bank</option>
                                <option value="Kotak Bank">Kotak Bank</option>
                                <option value="Laxmi Vilas Bank">Laxmi Vilas Bank</option>
                                <option value="Oriental Bank of Commerce">Oriental Bank of Commerce</option>
                                <option value="Punjab National Bank - Corporate Banking">Punjab National Bank - Corporate Banking</option>
                                <option value="Punjab National Bank - Retail Banking">Punjab National Bank - Retail Banking</option>
                                <option value="Punjab &amp; Sind Bank">Punjab &amp; Sind Bank</option>
                                <option value="Shamrao Vitthal Co-operative Bank">Shamrao Vitthal Co-operative Bank</option>
                                <option value="South Indian Bank">South Indian Bank</option>
                                <option value="State Bank of Bikaner &amp; Jaipur">State Bank of Bikaner &amp; Jaipur</option>
                                <option value="State Bank of Hyderabad">State Bank of Hyderabad</option>
                                <option value="State Bank of India">State Bank of India</option>
                                <option value="State Bank of Mysore">State Bank of Mysore</option>
                                <option value="State Bank of Patiala">State Bank of Patiala</option>
                                <option value="State Bank of Travancore">State Bank of Travancore</option>
                                <option value="Syndicate Bank">Syndicate Bank</option>
                                <option value="Tamilnad Mercantile Bank Ltd.">Tamilnad Mercantile Bank Ltd.</option>
                                <option value="UCO Bank">UCO Bank</option>
                                <option value="Union Bank of India">Union Bank of India</option>
                                <option value="United Bank of India">United Bank of India</option>
                                <option value="Vijaya Bank">Vijaya Bank</option>
                                <option value="Yes Bank Ltd">Yes Bank Ltd</option>
                                <option value="HDFC">HDFC</option>
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="ac_holder_name">Account Holder Name</label>
                            <input type="text" name="ac_holder_name" id="ac_holder_name" value="" class="form-control" placeholder="Account Holder Name" disabled="">
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="ifsc">IFSC</label>
                            <input type="text" name="ifsc" id="ifsc" value="{{$member->ifsc}}" class="form-control" placeholder="IFSC">
                            @if($errors->has('ifsc'))
                            <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('ifsc') }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="account_no">Account No</label>
                            <input type="number" name="account_no" id="account_no" value="{{$member->account_no}}" class="form-control" placeholder="Accoount No">
                            @if($errors->has('account_no'))
                            <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('account_no') }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                            <label for="photo">Photo</label>
                            <input type="file" name="photo" id="photo" value="" class="form-control">
                            @if($errors->has('photo'))
                            <span class="invalid-feedback" role="alert" style="color:red">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                            @enderror
                            <div>
                                <img src="{{$member->photo == NULL ? "" : asset('admin/production/images/'.$member->photo) }}" width="100" alt="">
                            </div>
                        </div>
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


