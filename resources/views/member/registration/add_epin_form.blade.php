
@extends('member.template.member_master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
    
                    <div class="x_title">
                        <h2>{{__('Add Epin')}}</h2>
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

                            {{ Form::open(['method' => 'post','route'=>'member.epin_submit']) }}
                            <div class="well" style="overflow: auto">

                                <div class="form-row mb-10 mb-2">
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                    </div>
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                        <label for="add_epin">{{__('Add EPIN')}}</label>
                                        <input type="text" name="epin" id="epin" class="form-control" placeholder="Add EPIN Number">
                                        <div id="myDiv">
                                            <img id="loading-image" src="{{asset('production/images/ajax-loader.gif')}}" style="display:none;"/>
                                        </div>
                                        <div id="epin_msg"></div>    
                                        <br>
                                    </div> 
                                    <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group submitBtn">
                                <button type="submit" name="skip" value="2" class="btn btn-default pull-right">Skip</button>
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
                    url: "{{route('member.validate_epin')}}",
                    method: "GET",
                    data: {query:query},
                    beforeSend: function() {
                        $("#loading-image").show();
                    },
                    success: function(data){
                        if(data == 1){
                            $('#epin_msg').html("<font color='red'><i class='fa fa-times'></i> Something went wrong!</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                            $('.submitBtn').hide();
                        }
                        else if(data == 2){
                            $('#epin_msg').html("<font color='red'><i class='fa fa-times'></i> Invalid EPIN</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                            $('.submitBtn').hide();
                        }else if(data == 3){
                            $('#epin_msg').html("<font color='red'><i class='fa fa-times'></i> EPIN is already been used!</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                            $('.submitBtn').hide();
                        }
                        else if(data == 5){
                            $('#epin_msg').html("<font color='red'><i class='fa fa-times'></i> Not your EPIN!</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                            $('.submitBtn').hide();
                        }else{
                            $('.submitBtn').html(data);
                            $("#loading-image").hide();
                            $('#epin_msg').html("<font color='success'><i class='fa fa-check'></i> Yay! Unused EPIN!</font>").fadeIn( "slow" );
                        }
                    }
                });
            }
            $(document).on('blur', '#epin', function(){
                var query = $(this).val();
                if(query){
                    fetch_member_data(query);
                }
            });
        });
    </script>
@endsection


