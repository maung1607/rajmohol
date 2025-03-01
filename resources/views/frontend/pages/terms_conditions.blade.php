@extends('layouts.frontend.app')

@section('title')
    Terms & Conditions- Rajmahal
@endsection

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 p-0"
        style="background-image: url({{ asset('/') }}frontend/img/carousel-1.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center pb-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Terms & Conditions</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Terms & Conditions</li>
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
                    <h6 class="section-title text-start text-primary text-uppercase">Terms & Conditions</h6>
                    <div class="my-4">
                       <h6>1. Booking & Reservation</h6>
                       <ul>
                        <li>All reservations are subject to availability.</li>
                        <li>A valid ID proof is required at the time of check-in.</li>
                        <li>Early check-in and late check-out are subject to availability and may incur additional charges</li>
                       </ul>
                    </div>
                    <div class="my-4">
                        <h6>2. Payment & Cancellation</h6>
                        <ul>
                         <li>Full or partial payment may be required at the time of booking.</li>
                         <li>Cancellation policies vary based on the type of booking. Please check your reservation details.</li>
                         <li>No-shows will be charged as per the hotel’s cancellation policy.</li>
                        </ul>
                     </div>
                     <div class="my-4">
                        <h6>3. Check-in & Check-out</h6>
                        <ul>
                         <li>Check-in time: 2:00 PM | Check-out time: 12:00 PM</li>
                         <li>Late check-out may be available at an additional cost.</li>
                        </ul>
                     </div>
                     <div class="my-4">
                        <h6>4. Guest Conduct</h6>
                        <ul>
                         <li>Guests are expected to maintain decorum and follow hotel policies.</li>
                         <li>Any damage to hotel property will be charged to the guest.</li>
                         <li>Smoking is prohibited in non-smoking areas.
                        </li>
                        </ul>
                     </div>
                     <div class="my-4">
                        <h6>5. Child & Extra Bed Policy</h6>
                        <ul>
                         <li>Children under a certain age may stay free with parents (as per hotel policy).</li>
                         <li>Extra beds may be available on request at an additional charge.</li>
                        </ul>
                     </div>
                     <div class="my-4">
                        <h6>6. Pets Policy</h6>
                        <ul>
                         <li>Pets are not allowed unless specified otherwise.</li>
                        </ul>
                     </div>
                     <div class="my-4">
                        <h6>7. Liability</h6>
                        <ul>
                         <li>The hotel is not responsible for any loss of valuables. Guests are advised to use in-room safes.</li>
                         <li>The hotel is not liable for unforeseen events such as natural disasters or emergencies.</li>
                        </ul>
                     </div>
                     <div class="my-4">
                        <h6>8. Privacy Policy</h6>
                        <ul>
                         <li>Guest information is kept confidential and used only for hotel services.</li>
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
