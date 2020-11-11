
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
            {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Wallet History</h2>
                        <button class="btn btn-danger pull-right" onclick="javascript:window.close()"><i class="fa fa-close"></i></button>
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
                            <table id="wallet_history" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>Sl. No</th>
                                  <th>User ID</th>
                                  <th>Member</th>
                                  <th>Amount</th>
                                  <th>Total Amount</th>
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
            {{-- <div class="col-md-2"></div> --}}
    </div>
</div>
<!-- /page content -->
@endsection

@section('script')
     <script type="text/javascript">
         $(function () {
            var table = $('#wallet_history').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: "50",
                ajax: "{{ route('admin.ajax.wallet_history',  ['id' => encrypt($id)]) }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'login_id', name: 'login_id',searchable: true},
                    {data: 'user_name', name: 'user_name',searchable: true},
                    {data: 'amount', name: 'amount',searchable: true},
                    {data: 'total_amount', name: 'total_amount',searchable: true},
                    {data: 'transaction_type', name: 'transaction_type', render:function(data, type, row){
                      if (row.transaction_type == '1') {
                        return "<button class='btn btn-success rounded'>Cr</a>"
                      }else{
                        return "<button class='btn btn-warning rounded'>Dr</a>"
                      }                        
                    }},              
                    {data: 'created_at', name: 'created_at',searchable: true},
                ]
            });
        });
     </script>
     @endsection




