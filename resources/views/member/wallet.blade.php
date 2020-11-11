
@extends('member.template.member_master')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
        <div class="row">
                {{-- <div class="col-md-2"></div> --}}
                <div class="col-md-12" style="margin-top:50px;">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>My Wallet</h2>
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
                            <div class="x_content text-center text-success">
                                <div class="col-md-6">
                                  <h3>Wallet Balance: <i class="fa fa-rupee"></i> {{$amount}}</h3>
                                </div>
                                <div class="col-md-3">
                                  {{ Form::open(['method' => 'post','route'=>'member.fund_transfer_from_wallet']) }}
                                  @if($amount > 0)
                                    <input type="number" class="form-control" name="fund_transfer" placeholder="How many amount to transfer?"> 
                                      @if($errors->has('fund_transfer'))
                                      <span class="invalid-feedback" role="alert" style="color:red">
                                          <strong>{{ $errors->first('fund_transfer') }}</strong>
                                      </span>
                                      @enderror
                                  </div>
                                  <div class="col-md-3">
                                    <button class="btn btn-success">Transfer Fund</button>
                                  </div>
                                </form>
                                  @endif
                                </div>
                            </div>
                        </div>
                        <div>
                          <div class="x_content">
                            <table id="wallet_history" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                              <thead>
                                <tr>
                                  <th>Sl. No</th>
                                  <th>Amount</th>
                                  <th>Total Amount</th>
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
</div>
<!-- /page content -->
@endsection

@section('script')
     <script type="text/javascript">
          $(function () {
            var table = $('#wallet_history').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('member.ajax.my_wallet_history') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'amount', name: 'amount',searchable: true},
                    {data: 'total_amount', name: 'total_amount',searchable: true},
                    {data: 'comment', name: 'comment',searchable: true},
                    {data: 'status', name: 'status', render:function(data, type, row){
                      if (row.transaction_type == '1') {
                        return "<button class='btn btn-success rounded'>Cr</a>"
                        }else if(row.transaction_type == '2'){
                          return "<button class='btn btn-warning rounded'>Dr</a>"
                          }                        
                        }},              
                    {data: 'created_at', name: 'created_at',searchable: true},
                ]
            });
            
        });
    </script>
 @endsection




