
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Important Notice</h2>
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
                                {{ Form::open(['method' => 'post','route'=>'admin.store_important_notice']) }}
                                <div class="well" style="overflow: auto">
                                    <div class="form-row mb-10">
                                        <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                            <label for="title">Notice Title</label>
                                            <input type="text" class="form-control" name="title" value="{{old('title')}}"  placeholder="Title">
                                                @if($errors->has('title'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('title') }}</strong>
                                                    </span>
                                                @enderror
                                        </div>                     
                                    </div>
                                    <div class="form-row mb-10">
                                        <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                            <label for="description">Notice Description</label>
                                            <textarea class="form-control" name="description" placeholder="Notice">{{old('description')}}</textarea>
                                                @if($errors->has('description'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @enderror
                                        </div>                     
                                    </div>
                                </div>
                                <div class="form-group">    	            	
                                    {{ Form::submit('Add', array('class'=>'btn btn-success pull-right')) }}  
                                </div>
                                {{ Form::close() }}

                                <h2>Notice Lists</h2>
                                <table id="notice_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                      <tr>
                                        <th>Sl. No</th>
                                        <th>Notice Title</th>
                                        <th>Description</th>
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
                {{-- <div class="col-md-2"></div> --}}
        </div>
</div>
<!-- /page content -->
@endsection

@section('script')
     <script type="text/javascript">
         $(function () {
            var i = 1;
            var table = $('#notice_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.ajax.notice_list') }}",
                columns: [
                    { "render": function(data, type, full, meta) {return i++;}},
                    {data: 'title', name: 'title',searchable: true},
                    {data: 'description', name: 'description',searchable: true},             
                    {data: 'created_at', name: 'created_at',searchable: true},
                    {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<button class='btn btn-success'>Active</a>"
                        }else if(row.status == '2'){
                          return "<button class='btn btn-danger'>Deactive</a>"
                          }                        
                    }},              
                    {data: 'action', name: 'action',searchable: true},
                ]
            });
            
        });
     </script>
@endsection