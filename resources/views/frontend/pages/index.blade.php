@extends('layouts.frontend.app')

@section('title')
    Home - Rajmahal
@endsection

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('/') }}frontend/img/carousel-1.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Relax, Refresh,
                                Rejuvenate</h6>
                            <h1 class="display-3 text-white mb-4 animated slideInDown">A Home Away from Home!</h1>
                            <a href="{{ route('rooms') }}"
                                class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Our Rooms</a>
                            <a href="{{ route('booking') }}"
                                class="btn btn-light py-md-3 px-md-5 animated slideInRight">Book A Room</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('/') }}frontend/img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Where Comfort
                                Meets Elegance</h6>
                            <h1 class="display-3 text-white mb-4 animated slideInDown">Book Your Stay Today!</h1>
                            <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Our
                                Rooms</a>
                            <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Book A Room</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('/') }}frontend/img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Experience Luxury
                                & Comfort at Rajmahal Hotel</h6>
                            <h1 class="display-3 text-white mb-4 animated slideInDown">Your Perfect Stay Awaits!</h1>
                            <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Our
                                Rooms</a>
                            <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Book A Room</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h6 class="section-title text-start text-primary text-uppercase">About Us</h6>
                    <h1 class="mb-4">Welcome to <span class="text-primary text-uppercase">Rajmahal</span></h1>
                    <p class="mb-4">
                        We’re delighted to have you with us. Enjoy a comfortable stay with our warm hospitality and
                        top-notch service. Let us know if you need any assistance.
                    </p>
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


    <!-- Room Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Our Rooms</h6>
                <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Rooms</span></h1>
            </div>
            <div class="row g-4">
                @foreach ($roomClasses as $roomClass)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            @if ($roomClass?->image)
                                <div class="position-relative">
                                    <img height="300px" class="img-fluid " src="{{ asset($roomClass?->image?->value) }}"
                                        alt="">
                                        <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">৳{{ $roomClass?->price??0 }}/Night</small>
                                </div>
                            @endif
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">{{ $roomClass->name }}</h5>
                                    <div class="ps-2">
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                        <small class="fa fa-star text-primary"></small>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>{{ $roomClass->number_of_beds }}
                                        Bed</small>
                                    <small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>{{ $roomClass->number_of_baths }}
                                        Bath</small>
                                    <small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
                                </div>
                                <p class="text-body mb-3">{{ $roomClass->description }}.</p>
                                <div class="d-flex justify-content-between">
                                    {{-- <a class="btn btn-sm btn-primary rounded py-2 px-4" href="">View Detail</a> --}}
                                    <a class="btn btn-sm btn-dark rounded py-2 px-4" href="">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Room End -->


    <!-- Video Start -->
    <div class="container-xxl py-5 px-0 wow zoomIn" data-wow-delay="0.1s">
        <div class="row g-0">
            <div class="col-md-6 bg-dark d-flex align-items-center">
                <div class="p-5">
                    <h6 class="section-title text-start text-white text-uppercase mb-3">Luxury Living</h6>
                    <h1 class="text-white mb-4">Discover A Brand Luxurious Hotel</h1>
                    <p class="text-white mb-4">
                        Experience unparalleled elegance and comfort at Luxury Living, a brand-new luxurious hotel designed
                        to redefine hospitality. Nestled in a prime location, our hotel offers exquisite accommodations,
                        world-class amenities, and impeccable service tailored to meet the highest standards.
                    </p>
                    <a href="" class="btn btn-primary py-md-3 px-md-5 me-3">Our Rooms</a>
                    <a href="" class="btn btn-light py-md-3 px-md-5">Book A Room</a>
                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <div class="ratio ratio-16x9" style="min-height: 430px;">
                        <iframe width="1280" height="1000" src="https://www.youtube.com/embed/a8thJyoDUy8"
                            title="কুয়াকাটার বেস্ট সার্ভিসের বাজেটফ্রেন্ডলি হোটেল | Best Hotel In Kuakata | Kuakata Hotel Review"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe width="1280" height="720" src="https://www.youtube.com/embed/a8thJyoDUy8"
                            title="কুয়াকাটার বেস্ট সার্ভিসের বাজেটফ্রেন্ডলি হোটেল | Best Hotel In Kuakata | Kuakata Hotel Review"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Start -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Our Services</h6>
                <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Services</span></h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-hotel fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">24/7 Front Desk Service</h5>
                        <p class="text-body mb-0">Assistance with check-in, check-out, and guest inquiries at any time.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-utensils fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">Housekeeping</h5>
                        <p class="text-body mb-0"> Daily room cleaning, fresh linens, and toiletries to ensure a
                            comfortable stay.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-spa fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">Room Service</h5>
                        <p class="text-body mb-0"> Convenient in-room dining with a variety of food and beverage options.
                        </p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-swimmer fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">Car Parking Facility </h5>
                        <p class="text-body mb-0">Safe and secure parking for guests.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-glass-cheers fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">Free Wi-Fi </h5>
                        <p class="text-body mb-0"> High-speed internet access for work or leisure.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-dumbbell fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3"> Transportation Service</h5>
                        <p class="text-body mb-0">Easy travel arrangements to and from the bus station .</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Testimonial Start -->
    <div class="container-xxl testimonial my-5 py-5 bg-dark wow zoomIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="owl-carousel testimonial-carousel py-5">
                <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                    <p>An amazing stay! The staff was friendly, the rooms were clean, and the food was delicious. Highly
                        recommend!</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded"
                            src="{{ asset('/') }}frontend/img/testimonial-1.jpg" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1">Zara Rahman</h6>
                            <small>Doctor</small>
                        </div>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                </div>
                <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                    <p>Excellent hospitality! The hotel ambiance was beautiful, and the service was top-notch. Will visit
                        again!</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded"
                            src="{{ asset('/') }}frontend/img/testimonial-2.jpg" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1">Abdullah </h6>
                            <small>Business Man</small>
                        </div>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                </div>
                <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                    <p>A perfect place for a relaxing getaway. Comfortable rooms and great amenities. Loved my stay!</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded"
                            src="{{ asset('/') }}frontend/img/testimonial-3.jpg" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1">Anondo Mondol</h6>
                            <small>Teacher</small>
                        </div>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                </div>
            </div>
        </div>
    </div>
@endsection
