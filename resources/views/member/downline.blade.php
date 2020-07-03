
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>My Downline</h2>
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
                                <table id="downline_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                    <tr>
                                      <th>Sl. No</th>
                                      <th>Member ID</th>
                                      <th>Member Name</th>
                                      <th>Left Member</th>
                                      <th>Right Member</th>
                                      <th>Parent</th>
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
                ajax: "{{ route('member.ajax.my_downline_list') }}",
                columns: [
                    {data: 'id', name: 'id',searchable: true},
                    {data: 'sponsorID', name: 'sponsorID',searchable: true},
                    {data: 'member_name', name: 'member_name' ,searchable: true}, 
                    {data: 'left_member', name: 'left_member' ,searchable: true}, 
                    {data: 'right_member', name: 'right_member' ,searchable: true}, 
                    {data: 'parent', name: 'parent',searchable: true},
                    {data: 'add_by', name: 'add_by' ,searchable: true},                 
                    {data: 'created_at', name: 'created_at' ,searchable: true},                 
                ]
            });
            
        });
     </script>
     @endsection




