
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>My FUND</h2>
                            <div class="text-center text-success"><h3>Total Fund: 
                                    <i class="fa fa-rupee"></i> 
                                    @if(empty($total_fund))
                                            0.0
                                    @else
                                        {{number_format($total_fund->amount, 2)}}</h3></div>
                                    @endif
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
                                    <th>Fund</th>
                                    <th>Available Fund</th>
                                    <th>Alloted To</th>
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
            ajax: "{{ route('member.ajax.my_epin_list') }}",
            columns: [
                {data: 'id', name: 'id',searchable: true},
                {data: 'fund', name: 'fund',searchable: true},
                {data: 'available_fund', name: 'available_fund' ,searchable: true},                 
                {data: 'name', name: 'name' ,searchable: true}, 
                {data: 'created_at', name: 'created_at' ,searchable: true},  
            ]
        });
        
    });
  </script>
 @endsection




