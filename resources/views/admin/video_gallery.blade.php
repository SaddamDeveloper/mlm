
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Video Gallery</h2>
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
                                {{ Form::open(['method' => 'post','route'=>'admin.store_video_gallery', 'enctype'=>'multipart/form-data']) }}
                                    <div class="well" style="overflow: auto">
                                        <div class="form-row mb-10">
                                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                                <label for="photo">Photo</label>
                                                <input type="file" class="form-control" name="photo">
                                                @if($errors->has('photo'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('photo') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>   
                                            <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                                <label for="youtube_id">Youtube ID</label>
                                                <input type="text" class="form-control" name="youtube_id">
                                                @if($errors->has('youtube_id'))
                                                    <span class="invalid-feedback" role="alert" style="color:red">
                                                        <strong>{{ $errors->first('youtube_id') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>   
                                            <div class="col-md-1 col-sm-12 col-xs-12 mb-3">
                                                {{ Form::submit('Add', array('class'=>'btn btn-success pull-right')) }}
                                            </div>                  
                                        </div>                 
                                    </div>
                                {{ Form::close() }}
                            </div>
                            <table class="table table-striped jambo_table bulk_action" id="gallery_list">
                                <thead>
                                    <tr class="headings">                
                                        <th class="column-title">Sl No. </th>
                                        <th class="column-title">Photo</th>
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
</div>
<!-- /page content -->
@endsection
@section('script')
 <script type="text/javascript">
     $(function () {
        var i = 1;
        var table = $('#gallery_list').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.ajax.get_video_gallery_list') }}",
            columns: [
                { "render": function(data, type, full, meta) {return i++;}},
                {data: 'photo', name: 'photo',searchable: true},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
 </script>
@endsection
