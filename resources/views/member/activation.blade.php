
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Activation</h2>
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
                        <div class="x_content">
                            <div class="well" style="overflow: auto">
                            {{ Form::open(['method' => 'post','route'=>'member.add_package']) }}
                                <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                    <div class="input-box">
                                        <label for="userId">User ID:</label>   
                                        <input type="text" readonly value="{{$member->login_id}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                    <div class="input-box">
                                        <label for="fund">Fund Amount:</label>   
                                        <input type="text" readonly value="{{isset($fund) ? number_format($fund->amount, 2) : "0.0"}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                    <label for="member_id">Member ID</label>
                                    <input type="text" name="member_id" id="member_id" value="{{old('member_id')}}" class="form-control" placeholder="Sponsor ID" required>
                                    <div id="myDiv">
                                        <img id="loading-image" src="{{asset('admin/production/images/ajax-loader.gif')}}" style="display:none;"/>
                                    </div>
                                    <div id="member_data"></div><br>
                                </div> 
                                <div class="col-md-4 mx-auto col-sm-12 col-xs-12 mb-3">
                                    <label for="packageAmt">Package Amount</label>
                                    <select name="package" id="package" class="form-control">
                                        <option value="">--SELECT PACKAGE--</option>
                                        @if(isset($package) && !empty($package))
                                            @foreach ($package as $pk)
                                                <option value="{{$pk->id}}" {{old('cast') == $pk->id ? 'selected':''}}>{{$pk->package_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('package'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('package') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">    
                                    {{ Form::submit('Submit', array('class'=>'btn btn-success pull-right')) }}  
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
</div>
<!-- /page content -->
@endsection

@section('script')
 <script type="text/javascript">
     $(function () {
        var table = $('#epin_list').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 50,
            ajax: "{{ route('member.ajax.fund') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'fund', name: 'fund',searchable: true},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
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
                            $('#member_data').html("<font color='red'>Invalid Member ID!</font>").fadeIn( "slow" );
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
            $(document).on('blur', '#member_id', function(){
                var query = $(this).val();
                if(query){
                    fetch_member_data(query);
                }
            });
  </script>
 @endsection
 




