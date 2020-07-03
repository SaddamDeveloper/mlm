
@extends('member.template.member_master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
                    <div>
                        <div class="x_content">
                            <div class="well" style="overflow: auto; text-align:center;">
                                <h1 class="text-success"><i class="fa fa-check-circle"></i> {{$success}} ! </h1><br>
                                <a href="{{route('member.dashboard')}}" class="">Return to Dashboard</a>
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

@section('script')
    <script>
        
    </script>
@endsection


