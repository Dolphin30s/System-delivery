@extends('layouts.master')

@section('content')
    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER PART ENDS ======-->

    <!--====== NAVBAR TWO PART START ======-->

    <section class="navbar-area sticky">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">

                        <a class="navbar-brand" href="/#" style="">
                            <span class="dy-luthorr-logo-name">Luthorr</span>
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item active"><a class="page-scroll" href="/#home">home</a></li>
                                <li class="nav-item"><a class="page-scroll" href="/#services">Services</a></li>
                                <li class="nav-item"><a class="page-scroll" href="/#industries">Industries</a></li>
                                <li class="nav-item"><a class="page-scroll" href="/#about">About</a></li>
                                <li class="nav-item"><a class="page-scroll" href="/#contact">Contact</a></li>
                                <li class="nav-item"><a class="page-scroll" href="/tracking">Tracking</a></li>
                            </ul>
                        </div>

                        <div class="navbar-btn d-none d-sm-inline-block">
                            <ul>
                                <li><a class="solid" href="{{route('home')}}">Login</a></li>
                            </ul>
                        </div>
                    </nav>
                    <!-- navbar -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>

    <!--====== CONTACT PART START ======-->

    <section id="contact" class="contact-area">
        <div class="container">
            <!-- Tracking Number Input Box -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-wrapper form-style-two pt-115">
                        <h4 class="contact-title pb-10">Tracking</h4>
                        <p class="text">Quick Track</p>
                        <form action="/tracking" method="POST">
                            @csrf
                            <div class="d-flex items-center mt-30 tracking-container">
                                <label class="tracking-caption">Tracking Number: </label>
                                <div class="form-input track-no-input">
                                    <div class="input-items default">
                                        <input id="tracking_no" name="tracking_no" type="text" placeholder="Tracking Number" value="{{$tracking_no??''}}" required>
                                    </div>
                                </div>
                                <div class="form-input light-rounded-buttons track-submit">
                                    <input type="submit" class="main-btn light-rounded-two" value="Track It">
                                </div>
                            </div>
                            <!-- row -->
                        </form>
                    </div>
                    <!-- contact wrapper form -->
                </div>
            </div>
            <!-- row -->

            @if(isset($order_detail))
            <!-- Tracking Number Input Box -->
            <div class="row mt-50">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Tracking Details</h5>
                            @foreach($tracking as $item)
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    {{$item['status']}}
                                </div>
                                <div class="col-md-8">
                                    {{$item['datetime']}}
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <h5>Order Details</h5>
                            <div class="row mt-2">
                                <div class="col-md-4">Order Number</div>
                                <div class="col-md-8">{{$order_detail['order_id']}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Tracking Number</div>
                                <div class="col-md-8">{{$order_detail['tracking_number']}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Order Status</div>
                                <div class="col-md-8">{{$order_detail['order_status']}}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Delivery Address</div>
                                <div class="col-md-8">{{$order_detail['delivery_address']}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @elseif (isset($tracking_no))
            <div class="row mt-50">
                <h5>No orders found for selected criteria</h5>
            </div>
            @endif
        </div>
        <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->
@endsection
