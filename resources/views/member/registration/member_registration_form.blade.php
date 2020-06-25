
@extends('member.template.member_master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
    
                    <div class="x_title">
                        <h2>Add New Member</h2>
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
                                    </div>
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        <label for="search_sponsor_id">Sponsor ID</label>
                                        <input type="text" name="search_sponsor_id" id="search_sponsor_id" value="{{old('search_sponsor_id')}}" class="form-control" placeholder="Sponsor ID" required>
                                        <div id="myDiv">
                                            <img id="loading-image" src="{{asset('member/production/images/ajax-loader.gif')}}" style="display:none;"/>
                                        </div>
                                        <div id="member_data"></div><br>
                                    </div> 
                                    
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        
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
                                      <input type="text" class="form-control" name="f_name" value="{{old('f_name')}}"  placeholder="Enter First Name" >
                                        @if($errors->has('f_name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('f_name') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="m_name">Middle Name</label>
                                      <input type="text" class="form-control" name="m_name" value="{{old('m_name')}}"  placeholder="Enter Middle Name" >
                                        @if($errors->has('m_name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('m_name') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                      <label for="l_name">Last Name*</label>
                                      <input type="text" class="form-control" name="l_name" value="{{old('l_name')}}" placeholder="Enter Last Name" >
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
                                        <label for="dob">DOB</label>
                                        <input type="date" name="dob" value="{{old('dob')}}" class="form-control"/>
                                        @if($errors->has('dob'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('dob') }}</strong>
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
                                        <label for="city">City*</label>
                                       <input type="text" class="form-control" name="city" value="{{old('city')}}"  placeholder="Enter City">
                                        @if($errors->has('city'))
                                              <span class="invalid-feedback" role="alert" style="color:red">
                                                  <strong>{{ $errors->first('city') }}</strong>
                                              </span>
                                          @enderror
                                        </div>
                                      <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="city">Pin*</label>
                                        <input type="text" class="form-control" name="pin" value="{{old('pin')}}" placeholder="Enter Pin No">
                                        @if($errors->has('city'))
                                              <span class="invalid-feedback" role="alert" style="color:red">
                                                  <strong>{{ $errors->first('city') }}</strong>
                                              </span>
                                          @enderror
                                        </div>
                                </div>
                            </div>
                            <div class="form-group">    	            	
                                {{ Form::submit('Next', array('class'=>'btn btn-success pull-right')) }}  
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
                        if(data == 5){
                            $('#member_data').html("<font color='red'>All lags are full! Try with another Sponsor ID</font>").fadeIn( "slow" );
                            $('#sponsorVal').val(data);
                            $("#loading-image").hide();
                        }else if(data == 1){
                            $('#member_data').html("<font color='red'>Invalid Sponsor ID!</font>").fadeIn( "slow" );
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

@section('css')
    <style>
        #search_sponsor_id{
            text-transform: uppercase;
        }
    </style>
@stop


