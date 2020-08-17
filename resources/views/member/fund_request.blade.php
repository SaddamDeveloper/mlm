
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Fund Requests</h2>
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
                                <div class="well">
                                {{ Form::open(['method' => 'post','route'=>'member.store_fund_requests', 'enctype' => 'multipart/form-data']) }}
                                    <div class="form-row mb-10 row">
                                        <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                            <label for="fund">Fund</label>
                                            <input type="number" name="fund" class="form-control" placeholder="How much fund you need?">
                                            @if($errors->has('fund'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('fund') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                            <label for="utr">UTR No.</label>
                                            <input type="number" name="utr" class="form-control" placeholder="UTR No">
                                            @if($errors->has('utr'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('utr') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 col-sm-12 col-xs-12 mb-3">
                                            <label for="photo">Attachment</label>
                                            <input type="file" name="photo" class="form-control">
                                            @if($errors->has('photo'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('photo') }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{ Form::submit('Request', array('class'=>'btn btn-success pull-right')) }}  
                                    </div>
                                {{ Form::close() }}
                                </div>
                            </div>
                            <div class="x_content">
                                <h3>Fund Requests List</h3>
                                <table id="fund_request" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Sl. No</th>
                                      <th>FUND</th>
                                      <th>UTR No</th>
                                      <th>Comment</th>
                                      <th>Added By</th>
                                      <th>Status</th>
                                      <th>Created At</th>
                                    </tr>
                                  </thead>
                                  <tbody>                       
                                  </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-2"></div> --}}
        </div>
</div>
<!-- /page content -->
@endsection

@section('script')
 <script type="text/javascript">
     $(function () {
        var table = $('#fund_request').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 50,
            ajax: "{{ route('member.ajax.fund_request_list') }}",
            columns: [
                {data: 'id', name: 'id',searchable: true},
                {data: 'fund', name: 'fund',searchable: true},
                {data: 'utr', name: 'utr',searchable: true},
                {data: 'comment', name: 'comment',searchable: true},
                {data: 'added_by', name: 'added_by',searchable: true},
                {data: 'status', name: 'status', render:function(data, type, row){
                    if (row.status == '1') {
                    return "<button class='btn btn-warning' disabled>Requested</a>"
                  }else{
                    return "<button class='btn btn-success' disabled>Sent</a>"
                  }                        
                }},
            {data: 'created_at', name: 'created_at',searchable: true},
            ]
        });
        
    });
  </script>
@endsection




