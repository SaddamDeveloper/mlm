
@extends('member.template.member_master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
    
                    <div class="x_title">
                        <h2>Terms & Condition</h2>
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

                            {{ Form::open(['method' => 'post','route'=>'member.terms_submit']) }}
                            <div class="well" style="overflow: auto">

                                <div class="form-row mb-10 mb-2">
                                   
                                    <div class="col-md-12 mx-auto col-sm-12 col-xs-12 mb-3">
                                       <p>
                                           

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam dolor lectus, cursus a iaculis nec, gravida eget lorem. Nam nec turpis semper, scelerisque dui sed, euismod elit. Proin egestas, velit ut pretium placerat, nisi augue laoreet lectus, a imperdiet lacus odio a eros. Nam a nunc vitae nulla varius egestas. Pellentesque in ligula maximus augue rhoncus condimentum ut eu metus. Aliquam at faucibus quam, sit amet pellentesque dolor. Aliquam in ex nec sem mattis porttitor. Phasellus blandit scelerisque erat non efficitur. Aenean ullamcorper ornare maximus.

In sit amet egestas lorem. Aliquam vestibulum, lectus vitae vulputate faucibus, purus nisl pretium ipsum, nec cursus diam dolor at sem. Etiam pellentesque non ligula ac tempus. Vestibulum a metus auctor, dapibus sapien at, rutrum orci. Nulla a sagittis lorem. Integer lobortis sodales faucibus. Phasellus aliquet pharetra urna at vehicula.

Phasellus laoreet, felis ultricies mollis vulputate, dui quam eleifend nisl, at commodo ipsum risus quis sem. In tempus porttitor felis eu vehicula. Etiam nec eros sed neque dapibus volutpat et quis quam. Nulla at mi hendrerit, mattis massa vel, dictum justo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce placerat dignissim feugiat. Donec tempor cursus eros, eu varius felis faucibus sit amet. Maecenas aliquet posuere facilisis. Vivamus aliquam libero vel velit finibus, congue consectetur dui tempus. Maecenas ac viverra leo. Vestibulum id justo pharetra, convallis arcu at, lobortis magna. Phasellus suscipit libero scelerisque congue tristique. Nam vel leo at massa dignissim viverra vel sit amet ligula. Vivamus convallis dolor nec iaculis feugiat. Curabitur molestie mollis diam, vel porta urna rhoncus eget.

Mauris commodo justo a justo sagittis eleifend. Cras nec rutrum urna. Suspendisse et viverra ex. Quisque vitae lorem semper, suscipit metus in, mattis est. Donec quam nisl, hendrerit commodo vulputate a, congue quis velit. Aenean ultrices venenatis placerat. Nunc facilisis arcu eget vehicula lobortis. Etiam volutpat neque at tellus euismod vehicula. Maecenas laoreet tortor magna, ut commodo sem mattis eu.

Nulla erat massa, placerat sit amet tincidunt quis, posuere vel risus. Integer a urna in nisi placerat vestibulum. Praesent non enim eu dui vestibulum ornare et non arcu. Integer placerat, sapien vel dapibus consectetur, leo velit imperdiet arcu, sed ullamcorper augue erat a ligula. Curabitur lacinia mattis mi in dignissim. In ac fermentum eros. Praesent interdum sapien non mauris aliquet lobortis. Suspendisse malesuada mattis felis, sit amet facilisis nisl elementum ut.

Suspendisse imperdiet sed justo id lobortis. Donec interdum volutpat lectus ut dictum. Praesent quis nibh quis nunc accumsan commodo eget vitae orci. Aliquam blandit lobortis nisl, in suscipit ligula congue eu. Integer cursus et odio imperdiet ultricies. In eu odio in magna accumsan viverra. Aliquam mi neque, suscipit nec aliquet quis, dignissim quis quam. In gravida dapibus odio, ut auctor lacus ultrices non. Aenean vestibulum nibh gravida turpis auctor gravida. Quisque tincidunt ac erat et commodo. Ut mattis, massa sed viverra dictum, est est hendrerit massa, vitae semper enim arcu sit amet augue. Cras tincidunt accumsan nulla, in gravida nisl ultricies ac. Praesent quis nulla aliquet, commodo ipsum id, consequat justo.

Curabitur maximus vehicula tortor at varius. Vivamus dignissim, tellus nec porta tincidunt, mauris quam dapibus arcu, ac congue nunc leo vel ex. Quisque quam libero, convallis vitae arcu mattis, volutpat scelerisque risus. Proin interdum quam non eros congue, quis vulputate turpis bibendum. Sed semper ac arcu eu tincidunt. Maecenas sagittis quam quis semper suscipit. Etiam laoreet venenatis faucibus. Nunc quam purus, tincidunt ut luctus vitae, blandit quis arcu. Phasellus sit amet velit bibendum, fringilla risus eu, gravida sapien. Vivamus placerat, neque et vulputate condimentum, eros enim feugiat ligula, id semper velit enim pharetra dolor. Phasellus semper mi quis iaculis pretium. Duis lacus metus, pharetra a est at, fringilla pulvinar tellus.

Phasellus urna ante, semper in urna vitae, eleifend consequat felis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec nec laoreet turpis, sed viverra nisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin elit urna, interdum iaculis consectetur et, consectetur vitae dui. Integer feugiat dignissim ante, ac finibus urna vulputate sit amet. Morbi sit amet risus a nulla bibendum tempor. Donec faucibus dui in libero consequat fringilla.

Suspendisse cursus vehicula diam, eget consequat lectus sollicitudin in. Aliquam id ligula tincidunt, tincidunt ex sed, vestibulum massa. Etiam posuere ornare felis, vitae aliquam felis fringilla ut. Vestibulum rutrum tempus orci, sit amet porta libero tincidunt eget. Mauris ullamcorper sed neque et ultrices. Donec interdum finibus laoreet. Nunc eleifend metus quis fringilla lobortis. Etiam dolor ante, semper sit amet posuere quis, vehicula et nibh. Aliquam lobortis eget urna eget vestibulum. Mauris mattis odio sed posuere consequat. Vestibulum et auctor augue. Suspendisse volutpat a eros vel sagittis. Donec id metus urna. Aenean vitae accumsan justo. Donec commodo sapien gravida lorem ultricies iaculis a id nisi. Aenean hendrerit orci ex, sed laoreet ipsum ullamcorper nec.

Vestibulum sit amet justo et quam malesuada molestie. Praesent convallis sem varius odio maximus, eget gravida lacus varius. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut congue rhoncus molestie. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi eget commodo ipsum. Mauris vulputate augue sapien, quis mattis eros malesuada in. Suspendisse consectetur rutrum magna, vel varius ante hendrerit quis. Sed maximus egestas nisi, condimentum eleifend sem accumsan rhoncus. 
                                       </p>
                                       <div style="text-align: right">
                                           <input type="checkbox" name="terms" value="1">
                                           <label for="terms"> I Agree Terms & Coditions</label><br>
                                       
                                        @if($errors->has('terms'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('terms') }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                        <br>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Submit', array('class'=>'btn btn-success pull-right')) }}  
                            </div>
                            {{ Form::close() }}
    
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
        $(document).ready(function(){
            // $('.member_data').hide();
            // fetch_member_data();
            function fetch_member_data(query){
                $.ajaxSetup({
	                headers: {
	                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                }
	            });
                $.ajax({
                    url: "{{route('member.search_sponsor_id')}}",
                    method: "GET",
                    data: {query:query},
                    beforeSend: function() {
                        $("#loading-image").show();
                    },
                    success: function(data){
                        if(data == 5){
                            $('#member_data').html("<font color='red'>All lags are full! Try with another Sponsor ID</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                        }else if(data == 1){
                            $('#member_data').html("<font color='red'>Invalid Sponsor ID!</font>").fadeIn( "slow" );
                            $("#loading-image").hide();
                        }else{
                            $('#member_data').html(data);
                            $("#loading-image").hide();
                        }
                    }
                });
            }
            $(document).on('blur', '#search_sponsor_id', function(){
                var query = $(this).val();
                if(query){
                    fetch_member_data(query);
                }
            });

            $( "#dob" ).datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: "-50:+0",
            });
        });

        /***
        * Display till today in DOB
        */
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        $('#dob').attr('max', maxDate);
    </script>
@endsection

@section('css')
    <style>
        #search_sponsor_id{
            text-transform: uppercase;
        }
    </style>
@stop


