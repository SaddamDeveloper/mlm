
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Downline Member</h2>
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
                                {{-- <input type="hidden" value="{{$fetch_member_data->id}}" name="id"> --}}
                                <table id="downline_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th>Sl. No</th>
                                        <th>Parent</th>
                                        <th>Member Name</th>
                                        <th>Left Member</th>
                                        <th>Right Member</th>
                                        <th>Added By</th>
                                        <th>Reistered At</th>
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
        var table = $('#downline_list').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 50,
            ajax: "{{ route('admin.ajax.downline_list', ['id' => encrypt($fetch_member_data->id)]) }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'parent', name: 'parent',searchable: true},
                {data: 'member_name', name: 'member_name' ,searchable: true}, 
                {data: 'left_member', name: 'left_member' ,searchable: true}, 
                {data: 'right_member', name: 'right_member' ,searchable: true}, 
                {data: 'add_by', name: 'add_by' ,searchable: true},                 
                {data: 'created_at', name: 'created_at' ,searchable: true},                 
            ]
        });
        
    });
 </script>
@endsection





