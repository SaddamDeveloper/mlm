
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Member List</h2>
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
                              
                            </div>
                        </div>
                        <div>
                            <div class="x_content">
                                <table id="member_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Sl. No</th>
                                      <th>User ID</th>
                                      <th>Name</th>
                                      <th>Mobile</th>
                                      <th>Left</th>
                                      <th>Right</th>
                                      <th>Status</th>
                                      <th>Action</th>
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
            var table = $('#member_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.ajax.get_member_list') }}",
                columns: [
                    {data: 'id', name: 'id',searchable: true},
                    {data: 'login_id', name: 'login_id',searchable: true},
                    {data: 'full_name', name: 'full_name',searchable: true},
                    {data: 'mobile', name: 'mobile',searchable: true},
                    {data: 'left', name: 'left',searchable: true},
                    {data: 'right', name: 'right',searchable: true},
                    {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<button class='btn btn-info'>Active</a>"
                      }else{
                        return "<button class='btn btn-danger'>Deactive</a>"
                      }                        
                    }},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
        });
     </script>
     @endsection




