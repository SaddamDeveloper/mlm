@extends('web.templet.master')

@section('seo')

@endsection

@section('content')
    
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Join Us</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- my account wrapper start -->
        <div class="my-account-wrapper section-padding pt-3">
            <div class="container">
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- My Account Page Start -->
                            <div class="myaccount-page-wrapper">
                                <!-- My Account Tab Menu Start -->
                                <div class="row">

                                    <!-- My Account Tab Content Start -->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="section-title text-center">
                                            <h2 class="title">Join Us</h2>
                                        </div>
                                        <div class="tab-content" id="myaccountContent">
                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade show active" id="account-info" role="tabpanel">
                                                <form>
                                                    <div class="myaccount-content mb-5">
                                                        <h5>Basic Details</h5>
                                                        <div class="account-details-form">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Sponsor ID</label>
                                                                        <input type="text" id="first-name" placeholder="Sponsor ID" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">HLP Name</label>
                                                                        <input type="text" id="last-name" placeholder="HLP Name" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Application Name</label>
                                                                        <input type="text" id="first-name" placeholder="Application Name" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">D.O.B</label>
                                                                        <input type="text" id="last-name" placeholder="D.O.B" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">E-mail ID</label>
                                                                        <input type="text" id="last-name" placeholder="E-mail ID" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Mobile No</label>
                                                                        <input type="text" id="first-name" placeholder="Mobile No" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Pan No</label>
                                                                        <input type="text" id="last-name" placeholder="Pan No" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Aadhar No</label>
                                                                        <input type="text" id="last-name" placeholder="Aadhar No" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Mobile No</label>
                                                                        <input type="text" id="first-name" placeholder="Mobile No" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Pan No</label>
                                                                        <input type="text" id="last-name" placeholder="Pan No" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Aadhar No</label>
                                                                        <input type="text" id="last-name" placeholder="Aadhar No" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-2">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Place</label>
                                                                        <select name="" id="">
                                                                            <option value="">Left</option>
                                                                            <option value="">Right</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Address</label>
                                                                        <textarea id="last-name" placeholder="Address"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="myaccount-content mb-5">
                                                        <h5>Bank Details</h5>
                                                        <div class="account-details-form">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Select Bank</label>
                                                                        <select name="" id="">
                                                                            <option value="">Left</option>
                                                                            <option value="">Right</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Account Holder Name</label>
                                                                        <input type="text" id="last-name" placeholder="Account Holder Name" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">IFSC</label>
                                                                        <input type="text" id="first-name" placeholder="IFSC" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Confirm IFSC</label>
                                                                        <input type="text" id="first-name" placeholder="Confirm IFSC" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Account Number</label>
                                                                        <input type="text" id="first-name" placeholder="Account Number" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Confirm Account Number</label>
                                                                        <input type="text" id="first-name" placeholder="Confirm IFSC" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="myaccount-content">
                                                        <h5>Security Details</h5>
                                                        <div class="account-details-form">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Login ID</label>
                                                                        <input type="text" id="first-name" placeholder="Login ID" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <br>
                                                                        <button type="button" class="btn btn-sqr mt-3">Check Availablity</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Password</label>
                                                                        <input type="text" id="first-name" placeholder="Password" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Confirm Password</label>
                                                                        <input type="text" id="last-name" placeholder="Confirm Password" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <button class="btn btn-sqr" style="background:#fff;border: 1px solid #c29958;color: #c29958;padding: 11px 25px;">Reset</button>
                                                                <button class="btn btn-sqr">Save Changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div> <!-- Single Tab Content End -->
                                        </div>
                                    </div> <!-- My Account Tab Content End -->
                                </div>
                            </div> <!-- My Account Page End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->
    </main>
@endsection

@section('script') 
@endsection
