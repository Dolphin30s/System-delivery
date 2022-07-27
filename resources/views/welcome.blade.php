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

                        <a class="navbar-brand" href="#" style="">
                            <span class="dy-luthorr-logo-name">Luthorr</span>
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTwo" aria-controls="navbarTwo" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item active"><a class="page-scroll" href="#home">home</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#services">Services</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#industries">Industries</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#about">About</a></li>
                                <li class="nav-item"><a class="page-scroll" href="#contact">Contact</a></li>
                                <li class="nav-item"><a class="page-scroll" href="/tracking">Tracking</a></li>
                            </ul>
                        </div>

                        <div class="navbar-btn d-sm-inline-block">
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

    <!--====== NAVBAR TWO PART ENDS ======-->

    <!--====== SLIDER PART START ======-->

    <section id="home" class="slider_area">
        <div id="carouselThree" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselThree" data-slide-to="0" class="active"></li>
                <li data-target="#carouselThree" data-slide-to="1"></li>
                <li data-target="#carouselThree" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="slider-content">
                                    <h1 class="title">Full services (WHITE GLOVE DELIVERY)</h1>
                                    <p class="text">We deliberately handpicked our finest delivery partner for this type of delivery. They are well trained and fitted to professionally install your parcel wherever you choose to.</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="{{route('request')}}?type=full">REQUEST A FULL SERVICES DELIVERY TODAY</a></li>
                                        <!-- <li><a class="main-btn rounded-two" href="#">DOWNLOAD</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- container -->
                </div>
                <!-- carousel-item -->

                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="slider-content">
                                    <h1 class="title">Heavy-weight SOLUTION</h1>
                                    <p class="text">This delivery solution is designed solely for companies or individuals that are in need of delivery of heavy, big and bulky items. The tools and the right delivery agents are selected for this solution.</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="{{route('request')}}?type=heavy">REQUEST A HEAVY-WEIGHT DELIVERY TODAY</a></li>
                                        <!-- <li><a class="main-btn rounded-two" href="#">DOWNLOAD</a></li> -->
                                    </ul>
                                </div>
                                <!-- slider-content -->
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                </div>
                <!-- carousel-item -->

                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="slider-content">
                                    <h1 class="title">RELAY RACE SOLUTION</h1>
                                    <p class="text">The relay race solution is designed for long and extra long routes. For instance, a 600 miles gig can only be efficiently carried out only if it had been executed by a chain of fresh and energetic drivers. Therefore we make sure that a driver only carries parcels in the areas that he has 2 years of delivery experience in.</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="{{route('request')}}?type=race">REQUEST A RELAY RACE SOLUTION TODAY</a></li>
                                        <!--  <li><a class="main-btn rounded-two" href="#">DOWNLOAD</a></li> -->
                                    </ul>
                                </div>
                                <!-- slider-content -->
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                </div>
                <!-- carousel-item -->

                <div class="carousel-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="slider-content">
                                    <h1 class="title">On-Demand SOLUTION</h1>
                                    <p class="text">This section is for companies or individuals requesting same-day solutions, or require extra variables.</p>
                                    <ul class="slider-btn rounded-buttons">
                                        <li><a class="main-btn rounded-one" href="{{route('request')}}?type=demand">REQUEST A ON-DEMAND DELIVERY TODAY</a></li>
                                        <!--  <li><a class="main-btn rounded-two" href="#">DOWNLOAD</a></li> -->
                                    </ul>
                                </div>
                                <!-- slider-content -->
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- container -->
                </div>
                <!-- carousel-item -->
            </div>

            <a class="carousel-control-prev" href="#carouselThree" role="button" data-slide="prev">
                <i class="lni lni-arrow-left"></i>
            </a>
            <a class="carousel-control-next" href="#carouselThree" role="button" data-slide="next">
                <i class="lni lni-arrow-right"></i>
            </a>
        </div>
    </section>

    <!--====== SLIDER PART ENDS ======-->

    <!--====== FEATRES TWO PART START ======-->

    <section id="services" class="features-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">Our Services</h3>
                        <h4 class="text">WE ARE SPECIALIZED IN VARIOUS SECTIONS OF DELIVERIES.</h4>
                        <p class="text">We manage daily routed and on-demand delivery services across the country, with a dedicated team of professionals on-call 24/7 to handle jobs of all shapes, sizes, timeframes and locations.<br/><br/>
                            With deep expertise in the, food, automotive, ecommerce and medical industries, we drive visibility, flexibility and predictability for customers across the delivery spectrum from first call to the final mile and everywhere between.</p>
                    </div>
                    <!-- row -->
                </div>
            </div>
        </div>
        <!-- container -->
    </section>

    <!--====== FEATRES TWO PART ENDS ======-->

    <!--====== INDUSTRIES PART START ======-->

    <section id="industries" class="industries-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">INDUSTRIES</h3>
                        <h4 class="text">HEALTHCARE</h4>
                        <p class="text">Delivering and handling medical specimens or equipment in a record time is extremely stressful and not an easy job. But with our well trained delivery professionals, we handle it perfectly every single day.<br/><br/>
                            We are forever adapting to every new regulations. The LUTHORR LLC Network is HIPAA and OSHA compliant, we have a very strict chain of custody protocol and our latest technology suite delivers real-time visibility and accountability for all pickups
                            and deliveries. Our national scope provides flexibility to quickly scale with our clients’ changing needs — allowing us to rapidly add new service locations.<br/><br/>
                            Whether specimens are ambient, refrigerated or frozen, patients and physicians across the country count on us every day to manage their time-sensitive medical deliveries with flawless execution and unmatched customer experiences. They have enough on their plates and that’s why they rely on LUTHORR LLC to take the worry out of the delivery process.<br/><br/>
                            We handle perfectly pharmaceutical deliveries as well. We have equipped all of our servers with bank’s level of cyber security materials, due to the extremely sensitive personal and medical informations we constantly handling.</p>
                    </div>
                    <!-- section title -->
                </div>
            </div>
        </div>
        <!-- container -->
    </section>

    <!--====== INDUSTRIES PART ENDS ======-->



    <!--====== TOOLS AND PARTS PART START ======-->

    <section id="tools_and_parts" class="tools_and_parts-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">TOOLS AND PARTS</h3>
                        <p class="text">Wether it’s a critical auto parts for your mechanic shop, or snowmobile to clear your driveways in blistering winter cold. We have it all covered, contact us today and request a quote.</p>
                    </div>
                    <!-- section title -->
                </div>
            </div>
        </div>
        <!-- container -->
    </section>

    <!--====== TOOLS AND PARTS PART ENDS ======-->

    <!--====== HUMAN RESOURCE PART START ======-->

    <section id="human_resource" class="human-resource-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">HUMAN RESOURCE</h3>
                        <p class="text">At LUTHORR LLC, we pay the most attention to our team. We are permanently creating a very inclusive environment at our facilities, therefore we will keep working together, listening to our valued customers and adapt to their needs. And most importantly, build a life long partnership based on performance and TRUST.</p>
                    </div>
                    <!-- section title -->
                </div>
            </div>
        </div>
        <!-- container -->
    </section>

    <!--====== HUMAN RESOURCE PART ENDS ======-->

    <!--====== ABOUT PART START ======-->

    <section id="about" class="about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="faq-content mt-45">
                        <div class="about-title mb-4">
                            <h6 class="sub-title">A Little More About Us</h6>
                            <h4 class="title">LUTHORR LLC, is the most trustworthy and on time logistics provider in the market.</h4>
                        </div>
                        <!-- faq title -->
                        <div class="about-accordion">
                            <p class="text">We provide the ease of mind and a well crafted solution for all your delivery needs.<br/><br/>
                                Whether its daily routed or on-demand delivery, same-day or next-day, our vast and well managed network of independent and dedicated professionals is on-call 24/7 to handle delivery needs of all shapes, sizes, timeframes, and locations.<br/><br/>
                                With years of experience in the automotive, e-commerce, medical industries, groceries and food industries. we partner with customers to create delivery strategies with business impact.<br/><br/>
                                Using the latest technology and the power of the modern days optimization algorithms, we’re transforming delivery from the old nonchalant, and poorly rated delivery style to active customer engagement from the first call to the final mile. We’re helping brands and businesses save money and achieve their goal in the modern world.</p>
                        </div>
                        <!-- faq accordion -->
                    </div>
                    <!-- faq content -->
                </div>
                <div class="col-lg-7">
                    <div class="about-image mt-50">
                        <img src="{{asset('/images/logis-56.jpg')}}" alt="about">
                    </div>
                    <!-- faq image -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>

    <!--====== ABOUT PART ENDS ======-->

    <!--====== OUR BRIGHTEST SIDE PART START ======-->

    <section id="brightest_side" class="brightest_side-area mb-100">
        <div class="container">
            <div class="row justify-content-center box-card">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center mt-30 mb-30">
                        <h3 class="title">OUR BRIGHTEST SIDE</h3>
                        <p class="text">At LUTHORR LLC, we are mainly focused on our customers satisfactions. That is the main reasons why we have a strict recruitment strategy of only hire a very experienced deliveries partner, we monitor and train them frequently to meet the highest standards deserved by our customers.</p>
                    </div>
                    <!-- section title -->
                </div>
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="{{asset('/images/logis-8.jpg')}}" alt="about">
                    </div>
                    <!-- faq image -->
                </div>
            </div>
        </div>
        <!-- container -->
    </section>

    <!--====== OUR BRIGHTEST SIDE PART ENDS ======-->

    <!--====== OUR APPROACH PART START ======-->

    <section id="our_approach" class="our_approach-area mb-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-10">
                        <h3 class="title">OUR APPROACH</h3>
                        <p class="text">The most effective way to achieve an optimum goal in the delivery world today is to mainly develop a strong algorithm like ours. It helps our delivery partners to access batches closest to them and suggest the fastest route to the destination. With those resources in our platform every customers can be ensure that they are getting the fastest delivery without breaking their banks.</p>
                    </div>
                    <!-- section title -->
                </div>
            </div>
        </div>
        <!-- container -->
    </section>

    <!--====== OUR APPROACH PART ENDS ======-->


    <!--====== TESTIMONIAL PART START ======-->

    <section id="testimonial" class="testimonial-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-5 col-lg-6">
                    <div class="testimonial-left-content mt-45">
                        <h6 class="sub-title">Testimonials</h6>
                        <h4 class="title">What Clients Says <br> About Us</h4>
                        <ul class="testimonial-line">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <p class="text">They trust us and testify to the quality of our services. They share their views with you. It's your turn, the family is waiting for you..</p>
                    </div>
                    <!-- testimonial left content -->
                </div>
                <div class="col-lg-6">
                    <div class="testimonial-right-content mt-50">
                        <div class="quota">
                            <i class="lni lni-quotation"></i>
                        </div>
                        <div class="testimonial-content-wrapper testimonial-active">
                            <div class="single-testimonial">
                                <div class="testimonial-text">
                                    <p class="text">“An endorsement is typically a well-known influencer giving their public support for a brand. But a testimonial is from a customer or client.”</p>
                                </div>
                                <div class="testimonial-author d-sm-flex justify-content-between">
                                    <div class="author-info d-flex align-items-center">
                                        <div class="author-image">
                                            <img src="{{asset('/assets/images/author-1.jpg')}}" alt="author">
                                        </div>
                                        <div class="author-name media-body">
                                            <h5 class="name">Luck Durand</h5>
                                            <span class="sub-title"></span>
                                        </div>
                                    </div>
                                    <div class="author-review">
                                        <ul class="star">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                        </ul>
                                        <span class="review">( 7 Reviews )</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonial -->
                            <div class="single-testimonial">
                                <div class="testimonial-text">
                                    <p class="text">“Weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish.”</p>
                                </div>
                                <div class="testimonial-author d-sm-flex justify-content-between">
                                    <div class="author-info d-flex align-items-center">
                                        <div class="author-image">
                                            <img src="{{asset('/assets/images/author-2.jpg')}}" alt="author">
                                        </div>
                                        <div class="author-name media-body">
                                            <h5 class="name">Mark Lob</h5>
                                            <span class="sub-title"></span>
                                        </div>
                                    </div>
                                    <div class="author-review">
                                        <ul class="star">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                        </ul>
                                        <span class="review">( 7 Reviews )</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonial -->
                            <div class="single-testimonial">
                                <div class="testimonial-text">
                                    <p class="text">“My testimonial is from a customer or client. They may be an unknown person to the reader, you need to be sure there isn't anything.”</p>
                                </div>
                                <div class="testimonial-author d-sm-flex justify-content-between">
                                    <div class="author-info d-flex align-items-center">
                                        <div class="author-image">
                                            <img src="{{asset('/assets/images/author-3.jpg')}}" alt="author">
                                        </div>
                                        <div class="author-name media-body">
                                            <h5 class="name">Alicia Tomson</h5>
                                            <span class="sub-title"></span>
                                        </div>
                                    </div>
                                    <div class="author-review">
                                        <ul class="star">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                        </ul>
                                        <span class="review">( 7 Reviews )</span>
                                    </div>
                                </div>
                            </div>
                            <!-- single testimonial -->
                        </div>
                        <!-- testimonial content wrapper -->
                    </div>
                    <!-- testimonial right content -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>

    <!--====== TESTIMONIAL PART ENDS ======-->


    <!--====== CONTACT PART START ======-->

    <section id="contact" class="contact-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10">
                    <div class="section-title text-center pb-30">
                        <h3 class="title">Contact</h3>
                        <p class="text">Do you have a concern? Our customer service is available for you. Happiness guaranteed!</p>
                    </div>
                    <!-- section title -->
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-map mt-30">
                        <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=46%20gramatan%20avenue%20Mount%20Vernon%20NY%2010550&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    </div>
                    <!-- row -->
                </div>
            </div>
            <!-- row -->
            <div class="contact-info pt-30">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-1 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-map-marker"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">46 gramatan avenue <br>Mount Vernon<br>NY 10550</p>
                            </div>
                        </div>
                        <!-- single contact info -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-2 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">ceo@luthorr.org</p>
                            </div>
                        </div>
                        <!-- single contact info -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-contact-info contact-color-3 mt-30 d-flex ">
                            <div class="contact-info-icon">
                                <i class="lni lni-phone"></i>
                            </div>
                            <div class="contact-info-content media-body">
                                <p class="text">+1 914-677-2023</p>
                            </div>
                        </div>
                        <!-- single contact info -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- contact info -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-wrapper form-style-two pt-115">
                        <h4 class="contact-title pb-10">WORK WITH US</h4>
                        <p class="text">We are permanently growing, therefore we need a dedicated, ready to learn, and hardworking individuals for our delivery network.<br/><br/>
                            Feel free to fill out this form today, and one of our representatives will get back to you as soon as possible.</p>
                        <form id="contact-form" action="/contact-form" method="post">
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
                                <div class="col-md-12">
                                    <div class="form-input mt-25">
                                        <label for="dy-contact-city">City</label>
                                        <div class="input-items default">
                                            <input id="dy-contact-city" name="city" type="text" placeholder="City" required>
                                        </div>
                                    </div>
                                    <!-- form input -->
                                </div>
                                <div class="col-md-12">
                                    <div class="form-input mt-25">
                                        <label for="dy-contact-message">Message</label>
                                        <div class="input-items default">
                                            <textarea id="dy-contact-message" name="message" placeholder="Message" minlength="3" required></textarea>
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
        <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->
@endsection
