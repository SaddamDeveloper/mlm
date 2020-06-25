
@extends('member.template.member_master')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-12" style="margin-top:50px;">
                <div class="x_panel">
    
                    <div class="x_title">
                        <h2>Product</h2>
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
                            {{ Form::open(['method' => 'post','route'=>'member.product_purchase']) }}
                            <div class="well" style="overflow: auto">

                                <div class="form-row mb-10 mb-2">
                                   
                                    <div class="col-md-12 mx-auto col-sm-12 col-xs-12 mb-3">
                                        <div class="productsction">
                                            <div class="producttitle">
                                                <h4>{{__('Product for APM')}}</h4>
                                                <p>{{__('Start your business to buy any one package')}}</p>
                                            </div>
                                            @if (count($products) > 0)
                                            <div class="productcontent">
                                                <div class="row">
                                                    @foreach ($products as $product)
                                                    <div class="col-md-4 singleproduct">
                                                        <label>
                                                            <input type="radio" name="product" value="{{$product->id}}">
                                                            <h5>{{$product->name}}</h5>
                                                            <img src="{{asset('member/product/thumb/'.$product->image1)}}" name="image1" alt="" class="fstchld">
                                                           <h5>
                                                                ₹ {{$product->price}}
                                                           </h5>
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            @else
                                            <div class="productcontent">
                                                <div class="row">
                                                    No Data Found
                                                </div>
                                            </div>
                                            @endif
                                        {{ $products->links() }}
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Next', array('class'=>'btn btn-success pull-right')) }}  
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



