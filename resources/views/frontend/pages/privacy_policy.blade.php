@extends('layouts.frontend.app')

@section('title')
Privacy Policy- Rajmahal
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0"
        style="background-image: url({{ asset('/') }}frontend/img/carousel-1.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center pb-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Privacy Policy</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Privacy Policy</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5 mb-6">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h6 class="section-title text-start text-primary text-uppercase">Privacy Policy</h6>
                    <p>At Rajmahal Hotel, we respect your privacy and are committed to protecting the personal information you share with us. This Privacy Policy explains how we collect, use, and safeguard your data.</p>
                    <div class="my-4">
                       <h6>1. Information We Collect</h6>
                       <p>We may collect the following personal information:</p>
                       <ul>
                        <li>Name, contact details (phone number, email, address)</li>
                        <li>Payment and billing details</li>
                        <li>ID proof for verification</li>
                        <li>Preferences and special requests</li>
                        <li>Feedback and reviews</li>
                       </ul>
                    </div>
                    <div class="my-4">
                        <h6>2. How We Use Your Information</h6>
                        <p>We use the collected data for:</p>
                        <ul>
                         <li>Booking and reservation processing</li>
                         <li>Personalizing your stay experience</li>
                         <li>Sending confirmations, updates, and promotional offers</li>
                         <li>Security and legal compliance</li>
                         <li>Improving our services and customer support
                        </li>
                        </ul>
                     </div>
                     <div class="my-4">
                        <h6>3. Information Sharing & Security</h6>
                        <ul>
                         <li>We do not sell or rent personal data to third parties.</li>
                         <li>Your data may be shared with service providers (e.g., payment processors) only for hotel-related services.</li>
                         <li>We take strict measures to ensure your data is secure and protected.</li>
                        </ul>
                     </div>
                     <div class="my-4">
                        <h6>4. Cookies & Tracking Technologies</h6>
                        <ul>
                         <li>Our website may use cookies to enhance user experience and improve services.</li>
                         <li>You can disable cookies through your browser settings.
                        </li>
                        </li>
                        </ul>
                     </div>
                     <div class="my-4">
                        <h6>5. Guest Rights 
                        </h6>
                        <ul>
                         <li>You can request access, modification, or deletion of your personal data.</li>
                        </ul>
                     </div>
                     
                    <div class="row g-3 pb-4">
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                    <p class="mb-0">Rooms</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                    <p class="mb-0">Staffs</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                    <h2 class="mb-1" data-toggle="counter-up">1234</h2>
                                    <p class="mb-0">Clients</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="">Explore More</a>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s"
                                src="{{ asset('/') }}frontend/img/about-1.jpg" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s"
                                src="{{ asset('/') }}frontend/img/about-2.jpg">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s"
                                src="{{ asset('/') }}frontend/img/about-3.jpg">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s"
                                src="{{ asset('/') }}frontend/img/about-4.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
