
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Plan</h2>
                            <div class="clearfix"></div>
                        </div>
                        @if (Session::has('message'))
                            <div class="alert alert-success" >{{ Session::get('message') }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
    
                            <div class="x_content">
                                {{ Form::open(['method' => 'post','route'=>'admin.store_plan', 'enctype'=>'multipart/form-data']) }}
                                    <div class="well" style="overflow: auto">
                                        <div class="form-row mb-10">
                                            <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                                <label for="plan">Plan</label>
                                                <input type="file" class="form-control" name="plan">
                                                    @if($errors->has('plan'))
                                                        <span class="invalid-feedback" role="alert" style="color:red">
                                                            <strong>{{ $errors->first('plan') }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>                     
                                            <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                                {{ Form::submit('Update', array('class'=>'btn btn-success pull-right')) }}  
                                            </div>
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            </div>
                            <table class="table table-striped jambo_table bulk_action" id="plan_list">
                                <thead>
                                    <tr class="headings">                
                                        <th class="column-title">Sl No. </th>
                                        <th class="column-title">Document</th>
                                        <th class="column-title">Action</th>
                                    </tr>
                                </thead>
                
                                <tbody>
                                    
                                </tbody>
                            </table>   
                    </div>
                </div>
        </div>
</div>
<!-- /page content -->
@endsection
@section('script')
 <script type="text/javascript">
     $(function () {
        var table = $('#plan_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.ajax.get_plan_list') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'document', name: 'document',searchable: true},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
 </script>
@endsection