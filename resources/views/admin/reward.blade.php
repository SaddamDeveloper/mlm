
@extends('admin.template.admin_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
    
                        <div class="x_title">
                            <h2>Reward</h2>
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
                                {{ Form::open(['method' => 'post','route'=>'admin.store_reward']) }}
                                <div class="well" style="overflow: auto">
                                    <div class="form-row mb-10">
                                        <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                            <label for="reward_name">Reward</label>
                                            <input type="text" class="form-control" name="reward_name" placeholder="Enter Reward Name">
                                            @if($errors->has('reward_name'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('reward_name') }}</strong>
                                                </span>
                                            @enderror
                                        </div>                     
                                        <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                            <label for="bv_pair">BV Pair</label>
                                            <input type="number" class="form-control" name="bv_pair" placeholder="BV Pair">
                                            @if($errors->has('bv_pair'))
                                                <span class="invalid-feedback" role="alert" style="color:red">
                                                    <strong>{{ $errors->first('bv_pair') }}</strong>
                                                </span>
                                            @enderror
                                        </div>    
                                    </div>                 
                                </div>
                                <div class="form-group">    	            	
                                    {{ Form::submit('Add', array('class'=>'btn btn-success pull-right')) }}  
                                </div>
                                    {{ Form::close() }}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">                
                                            <th class="column-title">Sl No. </th>
                                            <th class="column-title">Reward Name</th>
                                            <th class="column-title">BV</th>
                                            <th class="column-title">Created At</th>
                                            <th class="column-title">Status</th>
                                        </tr>
                                    </thead>
                    
                                    <tbody>
                                        @if(isset($reward) && !empty($reward) && count($reward) > 0)
                                        @php
                                            $count = 1;
                                        @endphp
                    
                                        @foreach($reward as $rw)
                                            <tr class="even pointer">
                                                <td class=" ">{{ $count++ }}</td>
                                                <td><label class="label label-success">{{ $rw->reward_name }}</label></td>
                                                <td class=" ">{{ $rw->bv_pair }}</td>
                                                <td class=" ">{{ $rw->created_at }}</td>
                                                <td>
                                                  @if($rw->status == 1)  
                                                    <button class="btn btn-success">Active</button>
                                                  @else
                                                    <button class="btn btn-danger">Deactive</button>
                                                  @endif
                                                </td>  
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5" style="text-align: center">Sorry No Data Found</td>
                                        </tr>
                                        @endif
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
