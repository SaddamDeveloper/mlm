
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Allocate Fund</h2>
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
                                <a href="{{route('admin.mem_allot_epin_form')}}" class="btn btn-primary">Allocate Fund</a>
                            </div>
                        </div>
                        <div>
                            <div class="x_content">
                                <table id="epin_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Sl. No</th>
                                      <th>Fund</th>
                                      <th>Alloted To</th>
                                      <th>Fund Available</th>
                                      <th>Transfered At</th>
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
            var table = $('#epin_list').DataTable({
                processing: true,
                serverSide: true,
                iDisplayLength: 50,
                ajax: "{{ route('admin.ajax.get_funds_list') }}",
                columns: [
                    {data: 'id', name: 'id',searchable: true},
                    {data: 'fund', name: 'fund',searchable: true},
                    {data: 'alloted_to', name: 'alloted_to' ,searchable: true}, 
                    {data: 'available_fund', name: 'available_fund' ,searchable: true},  
                    {data: 'created_at', name: 'created_at' ,searchable: true},  
                ]
            });
            
        });
     </script>
@endsection




