
@extends('member.template.member_master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
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
                            {{ Form::open(['method' => 'post','route'=>'member.test.add']) }}
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
                                            <img id="loading-image" src="{{asset('admin/production/images/ajax-loader.gif')}}" style="display:none;"/>
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
                                        <label for="how_many">How Many Joining?</label>
                                        <input type="text" name="how_many" id="" class="form-control" placeholder="How Many Join??">
                                        @if($errors->has('how_many'))
                                            <span class="invalid-feedback" role="alert" style="color:red;">
                                                <strong>{{ $errors->first('how_many') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">    	            	
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



