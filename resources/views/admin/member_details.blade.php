
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Member Details</h2>
                            <button class="btn btn-danger pull-right" onclick="javascript:window.close()"><i class="fa fa-close"></i></button>
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
                                <div class="x_content">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Member ID</th>
                                            <td>{{$fetch_member_data->login_id}}</td>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{$fetch_member_data->full_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{$fetch_member_data->email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mobile</th>
                                            <td>{{$fetch_member_data->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <th>Date of Birth</th>
                                            <td>{{$fetch_member_data->dob}}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{$fetch_member_data->status == 1 ? "ACTIVE" : "DEACTIVE"}}</td>
                                        </tr>
                                        <tr>
                                            <th>
                                                PAN
                                            </th>
                                            <td>{{$fetch_member_data->pan}}</td>
                                        </tr>
                                        <tr>
                                            <th>Aadhar No</th>
                                            <td>{{$fetch_member_data->aadhar}}</td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>{{$fetch_member_data->address}}</td>
                                        </tr>
                                        <tr>
                                            <th>Bank Name</th>
                                            <td>{{$fetch_member_data->bank_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Account Holder Name</th>
                                            <td>{{$fetch_member_data->ac_holder_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>IFSC</th>
                                            <td>{{$fetch_member_data->ifsc}}</td>
                                        </tr>
                                        <tr>
                                            <th>Account No</th>
                                            <td>{{$fetch_member_data->account_no}}</td>
                                        </tr>
                                        {{-- <tr>
                                            <th>Registered By</th>
                                            <td>{{$fetch_member_data->registered_by}}</td>
                                        </tr> --}}
                                    </table>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-2"></div> --}}
        </div>
</div>
<!-- /page content -->
@endsection





