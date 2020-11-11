
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>TDS(Tax)</h2>
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
                                {{ Form::open(['method' => 'post','route'=>'admin.store_tds']) }}
                                <div class="well" style="overflow: auto">
                                    <div class="form-row mb-10">
                                        <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                            <label for="tds">Enter TDS(in %)</label>
                                            <input type="text" class="form-control" name="tds" value="{{$tds->tds}}"  placeholder="Enter TDS">
                                                @if($errors->has('tds'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('tds') }}</strong>
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
                            <div class="x_content">
                                <h2 class="slide-title text-center">Balance : {{ number_format($tds_bal->amount, 2) }}</h2>
                                <table id="tds_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Sl. No</th>
                                      <th>Amount</th>
                                      <th>Total Amount</th>
                                      <th>Comment</th>
                                      <th>Created At</th>
                                      <th>Transaction Type</th>
                                    </tr>
                                  </thead>
                                  <tbody>                       
                                  </tbody>
                                </table>
                            </div>
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
        var table = $('#tds_list').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: "50",
            ajax: "{{ route('admin.ajax.tds_list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'amount', name: 'amount',searchable: true},
                {data: 'total_amount', name: 'total_amount',searchable: true},
                {data: 'comment', name: 'comment',searchable: true},
                {data: 'created_at', name: 'created_at',searchable: true},
                {data: 'transaction_type', name: 'transaction_type', render:function(data, type, row){
                  if (row.status == '1') {
                    return "<button class='btn btn-success rounded'>Cr</a>"
                  }else{
                    return "<button class='btn btn-warning rounded'>Dr</a>"
                  }                        
                }},              
            ]
        });
    });
  </script>
@endsection