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

    <section class="navbar-area">
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

    <section id="contact" class="request-area">
        <div class="request-back">
            <div class="container">
            <!-- contact info -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="request-wrapper form-style-two pt-115">
                        <h4 class="contact-title pb-10">{{$title}}</h4>
                        <p class="text">{{$text}}</p>
                        <form id="contact-form" action="/request" method="post">
                            @csrf
                            <input id="type" name="type" type="hidden" value="{{$type}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-input mt-25">
                                        <label for="dy-contact-first-name">First Name</label>
                                        <div class="input-items default">
                                            <input id="dy-contact-first-name" name="first_name" type="text" placeholder="First Name" required>
                                            <i class="lni lni-user"></i>
                                        </div>
                                    </div>
                                    <!-- form input -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input mt-25">
                                        <label for="dy-contact-last-name">Last Name</label>
                                        <div class="input-items default">
                                            <input id="dy-contact-last-name" name="last_name" type="text" placeholder="Last Name" required>
                                            <i class="lni lni-user"></i>
                                        </div>
                                    </div>
                                    <!-- form input -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input mt-25">
                                        <label for="dy-contact-email">Email</label>
                                        <div class="input-items default">
                                            <input id="dy-contact-email" type="email" name="email" placeholder="Email" required>
                                            <i class="lni lni-envelope"></i>
                                        </div>
                                    </div>
                                    <!-- form input -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input mt-25">
                                        <label for="dy-contact-phone">Phone Number</label>
                                        <div class="input-items default">
                                            <input id="dy-contact-phone" name="phone" type="text" placeholder="Phone Number" required>
                                            <i class="lni lni-phone"></i>
                                        </div>
                                    </div>
                                    <!-- form input -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input mt-25">
                                        <label for="dy-contact-company">Company</label>
                                        <div class="input-items default">
                                            <input id="dy-contact-company" name="company" type="text" placeholder="Company" required>
                                        </div>
                                    </div>
                                    <!-- form input -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input mt-25">
                                        <label for="dy-contact-industry">Industry</label>
                                        <div class="input-items default">
                                            <input id="dy-contact-industry" name="industry" type="text" placeholder="Industry" required>
                                        </div>
                                    </div>
                                    <!-- form input -->
                                </div>
                                <div class="col-md-12">
                                    <div class="form-input mt-25">
                                        <label for="dy-contact-comment">Comments</label>
                                        <div class="input-items default">
                                            <textarea id="dy-contact-comment" name="comment" placeholder="Comments" minlength="3" required></textarea>
                                            <i class="lni lni-pencil-alt"></i>
                                        </div>
                                    </div>
                                    <!-- form input -->
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="form-input light-rounded-buttons mt-30">
                                        <button class="main-btn light-rounded-two">Send Message</button>
                                    </div>
                                    <!-- form input -->
                                </div>
                            </div>
                            <!-- row -->
                        </form>
                    </div>
                    <!-- contact wrapper form -->
                </div>
            </div>
            <!-- row -->
        </div>
        </div>
        <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->
@endsection
