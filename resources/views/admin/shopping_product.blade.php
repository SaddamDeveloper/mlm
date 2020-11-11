
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Product List</h2>
                            <a href="{{route('admin.add_shopping_product')}}" class="btn btn-primary pull-right">Add New Product</a>
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
                                <table id="product_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th>Sl. No</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Product Photo</th>
                                        <th>MRP</th>
                                        <th>Price</th>
                                        <th>Short Description</th>
                                        <th>Long Description</th>
                                        <th>Created At</th>
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
        var table = $('#product_list').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 50,
            ajax: "{{ route('admin.shopping_product_list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name',searchable: true},
                {data: 'category_name', name: 'category_name' ,searchable: true}, 
                {data: 'main_image', name: 'main_image' ,searchable: true}, 
                {data: 'mrp', name: 'mrp' ,searchable: true, render: $.fn.dataTable.render.number( ',', '.', 2 )}, 
                {data: 'price', name: 'price' ,searchable: true, render: $.fn.dataTable.render.number( ',', '.', 2 )}, 
                {data: 'short_desc', name: 'short_desc' ,searchable: true}, 
                {data: 'long_desc', name: 'long_desc' ,searchable: true}, 
                {data: 'created_at', name: 'created_at' ,searchable: true},                 
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



