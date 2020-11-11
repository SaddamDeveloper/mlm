
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Payment Request</h2>
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
                        <div class="x_content row">
                            <h3 class="col-md-6">Wallet Balance: {{ number_format($wallet_bal, 2) }}</h3>
                            <div class="col-md-3">
                                {{ Form::open(['method' => 'post','route'=>'member.payment_request']) }}
                                @if($wallet_bal > 0)
                                  <input type="number" class="form-control" name="withdraw" placeholder="How many amount to withdraw?"> 
                                    @if($errors->has('withdraw'))
                                    <span class="invalid-feedback" role="alert" style="color:red">
                                        <strong>{{ $errors->first('withdraw') }}</strong>
                                    </span>
                                    @enderror
                                    <br>
                            </div>
                            <div class="col-md-3">
                                  <button class="btn btn-success">Withdraw</button>
                                </form>
                                @endif
                            </div>
                            <table id="payment_request_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Created At</th>
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
<!-- /page content -->
@endsection

@section('script')
 <script type="text/javascript">
     $(function () {
        var table = $('#payment_request_list').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 50,
            ajax: "{{ route('member.ajax.payment_request') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'amount', name: 'amount',searchable: true},
                {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<button class='btn btn-warning rounded'>Pending</button>"
                      }else{
                        return "<button class='btn btn-success rounded'>Approved</button>"
                      }                        
                    }},                     
                {data: 'created_at', name: 'created_at' ,searchable: true},  
            ]
        });
        
    });
  </script>
 @endsection




