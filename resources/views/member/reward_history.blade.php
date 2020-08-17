
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Reward History</h2>
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
                        <div class="x_content">
                            <table id="epin_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sl. No1</th>
                                    <th>Comment</th>
                                    <th>Status</th>
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
        var table = $('#epin_list').DataTable({
            processing: true,
            serverSide: true,
            iDisplayLength: 50,
            ajax: "{{ route('member.ajax.my_rewards_list') }}",
            columns: [
                {data: 'id', name: 'id',searchable: true},
                {data: 'comment', name: 'comment',searchable: true},
                {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.status == '1') {
                        return "<button class='btn btn-success rounded'>Cr</button>"
                      }else{
                        return "<button class='btn btn-warning rounded'>Dr</button>"
                      }                        
                    }},                     
                {data: 'created_at', name: 'created_at' ,searchable: true},  
            ]
        });
        
    });
  </script>
 @endsection




