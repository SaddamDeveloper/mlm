
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Commission History</h2>
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
                            <table id="commission_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Member</th>
                                    <th>Amount</th>
                                    <th>Comment</th>
                                    <th>Status</th>
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
@endsection

@section('script')
     <script type="text/javascript">
         $(function () {
            var table = $('#commission_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('member.ajax.my_commission_list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_name', name: 'user_name',searchable: true},
                    {data: 'amount', name: 'amount',searchable: true},
                    {data: 'comment', name: 'comment',searchable: true},
                    {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<button class='btn btn-success rounded'>Credited</a>"
                      }else{
                        return "<button class='btn btn-warning rounded'>Not Credited</a>"
                      }                        
                    }},              
                ]
            });
            
        });
     </script>
@endsection




