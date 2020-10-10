
@extends('member.template.member_master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
    
                    <div class="x_title">
                        <h2>Add New Member</h2>
                        <div class="pull-right">
                            <a href="{{route('member.refresh', ['id' => encrypt(1)])}}" class="btn btn-success" id="refresh"><i class="fa fa-refresh"></i></a>
                        </div> 
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
                            {{ Form::open(['method' => 'post','route'=>'member.add_new_member']) }}
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10 mb-2">
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        <label for="search_sponsor_id">User ID</label>
                                        <input type="text" name="search_sponsor_id" id="search_sponsor_id" value="{{old('search_sponsor_id')}}" class="form-control" placeholder="User ID">
                                        @if($errors->has('search_sponsor_id'))
                                            <span class="invalid-feedback" role="alert" style="color:red;">
                                                <strong>{{ $errors->first('search_sponsor_id') }}</strong>
                                            </span>
                                        @enderror
                                        <div id="myDiv">
                                            <img id="loading-image" src="{{asset('images/ajax-loader.gif')}}" style="display:none;"/>
                                        </div>
                                        <div id="member_data"></div><br>
                                    </div> 
                                    
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        <label class="control-label ">Select Leg*</label>
                                            <select name="leg" id="leg" class="form-control">
                                                <option value="" disabled selected>--SELECT Leg--</option>
                                                <option value="1" {{old('leg') == '1'?'selected':''}}>Left</option>
                                                <option value="2" {{old('leg') == '2'?'selected':''}}>Right</option>
                                            </select>
                                            @if($errors->has('leg'))
                                            <span class="invalid-feedback" role="alert" style="color:red;">
                                                <strong>{{ $errors->first('leg') }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-row mb-10 mb-2">
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-3">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="f_name">First Name*</label>
                                      <input type="text" class="form-control ac_name_check" name="f_name" id="f_name" value="{{old('f_name')}}"  placeholder="Enter First Name" >
                                        @if($errors->has('f_name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('f_name') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="m_name">Middle Name</label>
                                      <input type="text" class="form-control ac_name_check" name="m_name" id="m_name" value="{{old('m_name')}}"  placeholder="Enter Middle Name" >
                                        @if($errors->has('m_name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('m_name') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="l_name">Last Name*</label>
                                      <input type="text" class="form-control ac_name_check" name="l_name" id="l_name" value="{{old('l_name')}}" placeholder="Enter Last Name" >
                                        @if($errors->has('l_name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('l_name') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="email">Email*</label>
                                      <input type="email" class="form-control" name="email" value="{{old('email')}}"  placeholder="Enter Email" >
                                      @if($errors->has('email'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="mobile">Mobile*</label>
                                      <input type="text" class="form-control" name="mobile" value="{{old('mobile')}}" placeholder="Enter Mobile No" >
                                      @if($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="dob">DOB</label>
                                        <input type="text" name="dob" value="{{old('dob')}}" class="form-control"/>
                                        @if($errors->has('dob'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('dob') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
    
                                <div class="form-row mb-3">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="pan">PAN No*</label>
                                       <input type="text" class="form-control" name="pan" value="{{old('pan')}}"  placeholder="PAN Card">
                                        @if($errors->has('pan'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('pan') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="aadhar">Aadhar No</label>
                                       <input type="text" class="form-control" name="aadhar" value="{{old('aadhar')}}"  placeholder="Enter Aadhar No">
                                        @if($errors->has('aadhar'))
                                              <span class="invalid-feedback" role="alert" style="color:red">
                                                  <strong>{{ $errors->first('aadhar') }}</strong>
                                              </span>
                                          @enderror
                                      </div> 
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="address">Address</label>
                                       <textarea type="text" class="form-control" name="address" placeholder="Enter Address">{{old('address')}}</textarea>
                                    </div> 
                                </div>
                            </div>
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-3">
                                    <h3>Bank Details</h3>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="bank">Select Bank</label>
                                        <select name="bank" id="bank" class="form-control">
                                            <option value="" disabled selected>--SELECT BANK--</option>
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
                                        @if($errors->has('bank'))
                                              <span class="invalid-feedback" role="alert" style="color:red">
                                                  <strong>{{ $errors->first('bank') }}</strong>
                                              </span>
                                          @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="ac_holder_name">Account Holder Name</label>
                                        <input type="text" name="ac_holder_name" id="ac_holder_name" value="{{old('ac_holder_name')}}" class="form-control" placeholder="Account Holder Name" disabled>
                                        @if($errors->has('ac_holder_name'))
                                              <span class="invalid-feedback" role="alert" style="color:red">
                                                  <strong>{{ $errors->first('ac_holder_name') }}</strong>
                                              </span>
                                          @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="ifsc">IFSC</label>
                                        <input type="text" name="ifsc" id="ifsc" value="{{old('ifsc')}}" class="form-control" placeholder="IFSC">
                                        @if($errors->has('ifsc'))
                                              <span class="invalid-feedback" role="alert" style="color:red">
                                                  <strong>{{ $errors->first('ifsc') }}</strong>
                                              </span>
                                          @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="confirm_ifsc">Confirm IFSC</label>
                                        <input type="text" name="confirm_ifsc" id="confirm_ifsc" value="{{old('confirm_ifsc')}}" class="form-control" placeholder="Confirm IFSC">
                                        @if($errors->has('confirm_ifsc'))
                                              <span class="invalid-feedback" role="alert" style="color:red">
                                                  <strong>{{ $errors->first('confirm_ifsc') }}</strong>
                                              </span>
                                          @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="account_no">Account No</label>
                                        <input type="number" name="account_no" id="account_no" value="{{old('account_no')}}" class="form-control" placeholder="Accoount No">
                                        @if($errors->has('account_no'))
                                              <span class="invalid-feedback" role="alert" style="color:red">
                                                  <strong>{{ $errors->first('account_no') }}</strong>
                                              </span>
                                          @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="confirm_account">Confirm Account No</label>
                                        <input type="number" name="confirm_account" id="confirm_account" value="{{old('confirm_account')}}" class="form-control" placeholder="Confirm Account No">
                                        @if($errors->has('confirm_account'))
                                              <span class="invalid-feedback" role="alert" style="color:red">
                                                  <strong>{{ $errors->first('confirm_account') }}</strong>
                                              </span>
                                          @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-3">
                                    <h2>Login Credentials</h2>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="">Enter Login ID*</label>
                                        <input type="text" class="form-control" name="login_id" id="login_id" value="{{old('login_id')}}" placeholder="Enter Login ID">
                                        @if($errors->has('login_id'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('login_id') }}</strong>
                                            </span>
                                        @enderror
                                        <button class="btn btn-success" id="check_login">Check Availability</button>
                                        <img id="loading-image-login" src="{{asset('images/ajax-loader.gif')}}" style="display:none;"/>
                                        <div id="login_name_show"></div><br>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="password">Password*</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                        @if($errors->has('password'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="password">Confirm Password*</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
                                        @if($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="test7" required/>
                                <label for="test7">Accept terms & conditions</label>    	            	
                                {{ Form::submit('Submit', array('class'=>'btn btn-success pull-right')) }}  
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

        <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
            </div>
            <div class="modal-body">
                <p>
                    <b>T</b>he undersigned distributor acknowledges that he/she has read, understood and accepted all the terms and conditions on the back of this application plus agreement form and SSSDREAM LIFE E- COMMERCE PVT.LTD marketing plan and agrees to comply with all the terms laid down. The distributor also agrees to read and comply with further amendments, which will be made from time to time.
                    Any amount payable to the distributor as commission/ bonus/incentives by the company is inclusive of all taxes, by whatever name they are called, including Income Tax, GST, CST, Professional Tax, Surcharge, Cess and other taxes by the State Government or Central Government.
                    These taxes are payable by the distributor as and when they are required to paid under current laws.
                    (Please send a photocopy of your PAN Card, Address Proof, Aadhar Card & Bank Pass Book or Cancel Cheque (KYC Documents) for entry in system) I at this moment confirm that I have personally explained to him/her about the company’s policies and activities as per marketing plan. He/she is willing to become by SSSDREAM LIFE E- COMMERCE PVT.LTD distributor after understanding the same.
                </p><br>
                <p>
                    Company is not responsible for any adverse commitment given by any Distributor to the applicant.
                    Demand draft / Online payments should be in favour of SSSDREAM LIFE E- COMMERCE PVT.LTD, payable at Guwahati. Cheques are not acceptable.
                    
                    By signing this from, the distributor acknowledges that he/she has thoroughly read and complies with the terms and conditions mentioned in the company’s marketing plan.
                    
                    Each applicant should be at least 18 years of age at the time of application, to become a SSSDREAM LIFE E- COMMERCE PVT.LTD distributor.
                    
                    The signing of this form in no way makes an employee or agent of the Company Name.
                    
                    This form is an application and an agreement to appoint an individual as a self- employed distributor for the sale of SSSDREAM LIFE E- COMMERCE PVT.LTD products & services.
                    
                    Distributors are not permitted under any circumstances to market any product, which is not approved by SSSDREAM LIFE E- COMMERCE  PVT.LTD in their network.
                    Husband and wife. Desirous of becoming distributors have to be sponsored under a single membership. If the spouse is already a distributor, then the other must join as a part of the same business membership.
                    
                    A distributor who does not adhere to these rules can be suspended, pending inquiry or terminated from the membership.
                    
                    The registration is non- transferable and non- refundable.
                    
                    In case of any dispute, default or complaint, the company’s decision will be final.
                    
                    All disputes are subject to the jurisdiction of Guwahati, India.
                    
                    If your monthly commission is below INR 100 & we don’t have your updated bank details, then we will issue a product voucher against your commission amount.
                    
                    Submission of correct Bank details to the company is the full responsibility of own applicant.
                    
                    Renewal of Distributorship is mandatory describe in the marketing plan of the company.
                </p>
                
                
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            function fetch_member_data(query){
                $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });
                $.ajax({
                    url: "{{route('member.search_sponsor_id')}}",
                    method: "GET",
                    data: {query:query},
                    beforeSend: function() {
                        $("#loading-image").show();
                    },
                    success: function(data){
                        if(data == 1){
                            $('#member_data').html("<font color='red'>Invalid User ID!</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                            $('#sponsorVal').val(data);
                        }else{
                            $('#member_data').html(data);
                            $('#sponsorVal').val("200");
                            $("#loading-image").hide();
                        }
                    }
                });
            }
            $(document).on('blur', '#search_sponsor_id', function(){
                var query = $(this).val();
                if(query){
                    fetch_member_data(query);
                }
            });
            function check_login(query){
                $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
                });
                $.ajax({
                    url: "{{route('member.login_id_check')}}",
                    method: "GET",
                    data: {query:query},
                    beforeSend: function() {
                        $("#loading-image-login").show();
                    },
                    success: function(data){
                        if(data == 1){
                            $('#login_name_show').html("<font color='red'>Sorry Username is already taken!</font>").fadeIn( "slow" );
                            $("#loading-image-login").hide();
                            $("#login_id")
                        }else{
                            $('#login_name_show').html("<font color='green'>Yay Username is available!</font>");
                            $("#loading-image-login").hide();
                        }
                    }
                });
            }
            $(document).on('blur', '#search_sponsor_id', function(e){
                e.preventDefault();
                var query = $(this).val();
                if(query){
                    fetch_member_data(query);
                }
            });
            $(document).on('blur', '.ac_name_check', function(){
                var fname = $('#f_name').val();
                var mname = $('#m_name').val();
                var lname = $('#l_name').val();
                var fullName = fname + " " + mname +" "+ lname;
                $("#ac_holder_name").val(fullName);
            });
            $(document).on('click', '#check_login', function(e){
                e.preventDefault();
                var query = $('#login_id').val();
                if(query){
                    check_login(query);
                }
            });
            $('input[type="checkbox"]').on('change', function(e){
                if(e.target.checked){
                    $('#myModal').modal();
                }
            });
            $( "#dob" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-50:+0",
            });
        });

        /***
        * Display till today in DOB
        */
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('#dob').attr('max', maxDate);
    </script>
@endsection



