
@extends('admin.template.admin_master')

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
                        <div>
                            <div class="x_content">
                                {{-- <a href="{{route('admin.mem_add_epin_form')}}" class="btn btn-primary">Add New EPIN</a> --}}
                                {{-- <a href="{{route('admin.mem_allot_epin_form')}}" class="btn btn-primary">Allot EPIN</a> --}}
                            </div>
                        </div>
                        <div>
                            <div class="x_content">
                                <table id="commission_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Sl. No</th>
                                      <th>User ID</th>
                                      <th>Member</th>
                                      <th>Amount</th>
                                      <th>Comment</th>
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
            var i = 1;
            var table = $('#commission_list').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: "50",
                ajax: "{{ route('admin.ajax.commission_list') }}",
                columns: [
                    { "render": function(data, type, full, meta) {return i++;}},
                    {data: 'login_id', name: 'login_id',searchable: true},
                    {data: 'user_name', name: 'user_name',searchable: true},
                    {data: 'amount', name: 'amount',searchable: true},
                    {data: 'comment', name: 'comment',searchable: true},
                    {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<button class='btn btn-success rounded'>Credited</a>"
                      }else if(row.status == '2'){
                        return "<button class='btn btn-warning rounded'>Capping</a>"
                      }else{
                        return "<button class='btn btn-warning rounded'>CutOFF</a>"
                      }                        
                    }},              
                    {data: 'created_at', name: 'created_at',searchable: true}
                ]
            });
            
        });
     </script>
     @endsection




