@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Reward List</h2>
                            <div class="clearfix"></div>
                        </div>
                        @if (Session::has('message'))
                            <div class="alert alert-success" >{{ Session::get('message') }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                        <div class="x_content">
                            <table id="package" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>UserID</th>
                                    <th>Name</th>
                                    <th>Rank</th>
                                    <th>BV</th>
                                    <th>Added By</th>
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
        var table = $('#package').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 50,
            ajax: "{{ route('admin.ajax.distributor_details') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'package_name', name: 'package_name',searchable: true},
                {data: 'login_id', name: 'login_id' ,searchable: true}, 
                {data: 'name', name: 'name' ,searchable: true}, 
                {data: 'bv', name: 'bv' ,searchable: true}, 
                {data: 'added_by', name: 'added_by' ,searchable: true},                 
                {data: 'created_at', name: 'created_at' ,searchable: true},                 
                // {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
  </script>
 @endsection




