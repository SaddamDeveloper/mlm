@extends('admin.template.admin_master')

@section('content')
<div class="right_col" role="main">
        <div class="row">
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Payable Member</h2>
                            <div class="clearfix"></div>
                        </div>
                        @if (Session::has('message'))
                            <div class="alert alert-success" >{{ Session::get('message') }}</div>
                        @endif
                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif
                        <div class="x_content">
                            <table id="package" class="table table-striped jambo_table bulk_action" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>UserID</th>
                                    <th>Member</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 1;
                                    @endphp
                                    @forelse ($wallets ?: [] as $wallet)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $wallet->member->login_id }}</td>
                                            <td>{{ $wallet->member->full_name }}</td>
                                            <td>{{ $wallet->amount }}</td>
                                            <td>
                                                @if($wallet->status == 1)
                                                    <label class="label label-success">Enable</label>
                                                @else
                                                    <label class="label label-danger">Disable</label>
                                                @endif
                                            </td>
                                            <td>{{ $wallet->created_at }}</td>
                                        </tr>                       
                                    @empty
                                        <tr>
                                        </tr>                                
                                    @endforelse
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
    <script>
        $(document).ready(function(){
            $("#package").DataTable();
        });
    </script>
@endsection



