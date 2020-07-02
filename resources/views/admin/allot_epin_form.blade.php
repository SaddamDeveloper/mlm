
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Allot EPIN</h2>
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
                                {{ Form::open(['method' => 'post','route'=>'admin.mem_allot_epin']) }}
                                    <div class="well" style="overflow: auto">
                                        <div class="form-row mb-10">
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                            <label for="name">User ID:</label>
                                            <input type="text" class="form-control" name="searchMember" id="searchMember" value="{{old('user_id')}}"  placeholder="Search User ID">
                                            </div>                     
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <div id="myDiv">
                                                    <img id="loading-image" src="{{asset('admin/production/images/ajax-loader.gif')}}" style="display:none;"/>
                                                </div>
                                                <div id="search_data">
                                                    @if($errors->has('epin'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('epin') }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>                     
                                        </div>
                                    </div>

                                <div class="form-group">    	            	
                                    {{ Form::submit('Allot Epin', array('class'=>'btn btn-success pull-right')) }}  
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
            function searchMember(query){
                $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });

                $.ajax({
                    url: "{{route('member.search_member_id')}}",
                    method: "GET",
                    data: {query:query},
                    beforeSend: function() {
                        $("#loading-image").show();
                    },
                    success: function(data){
                        if(data == 5){
                            $('#search_data').html("<font color='red'>Member not found!</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                        }
                        else if(data == 1){
                            $('#search_data').html("<font color='red'>Something went wrong!</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                        }
                        else{
                            $('#search_data').html(data);
                            $("#loading-image").hide();
                        }
                    }
                });
            }

            $(document).on('blur', '#searchMember', function(){
                var query = $(this).val();
                if(query){
                    searchMember(query);
                }
            });

        });
    </script>
@endsection
@section('css')
    <style>
        #searchMember{
            text-transform: uppercase;
        }
    </style>
@stop


