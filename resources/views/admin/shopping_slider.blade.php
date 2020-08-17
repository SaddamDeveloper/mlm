
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Slider List</h2>
                            <a href="{{route('admin.add_slider')}}" class="btn btn-primary pull-right">Add New Slider</a>
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
                                <table id="slider_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th>Sl. No</th>
                                        <th>Slider Name</th>
                                        <th>Slider Image</th>
                                        <th>Offer</th>
                                        <th>Banner Title</th>
                                        <th>Banner Sub Title</th>
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
        var table = $('#slider_list').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 50,
            ajax: "{{ route('admin.shopping_slider_list') }}",
            columns: [
                {data: 'id', name: 'id',searchable: true},
                {data: 'slider_name', name: 'slider_name',searchable: true},
                {data: 'slider_image', name: 'slider_image' ,searchable: true}, 
                {data: 'offer', name: 'offer' ,searchable: true}, 
                {data: 'banner_title', name: 'banner_title' ,searchable: true}, 
                {data: 'banner_subtitle', name: 'banner_subtitle' ,searchable: true}, 
                {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<label class='label label-success rounded'>Enabled</label>"
                      }else{
                        return "<label class='label label-warning rounded'>Disbaled</label>"
                      }                        
                    }},                 
                {data: 'action', name: 'action' ,searchable: true},                 
            ]
        });
        
    });
 </script>
@endsection



