@extends('inc.layout')

@section('title', 'Home')

@section('content')

    <!-- Swiper carousel start -->
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                @foreach ($slider as $s)
                <div class="swiper-slide">
                    <img src="{{ asset($s->image) }}" class="w-100 d-block" />
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Swiper carousel end -->

    <!-- Check availability form start -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Booking Availability</h5>
                <form action="" method="post">
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-in</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Adult</label>
                            <select class="form-select shadow-none">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500;">Children</label>
                            <select class="form-select shadow-none">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mt-2">
                            <button class="btn text-white shadow-none custom-bg mb-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Check availability form end -->

    <!-- Our Rooms start -->
    <h2 class="mt-5 pt-4 text-center fw-bold h-font">OUR ROOM</h2>
    <div class="container">
        <div class="row">
            @foreach ($rooms as $room)
            <div class="col-lg-4 col-md-6 py-3">
                <div class="card border-0 shadow" style="max-width: 100%; margin:auto;">
                    @foreach ($roomImage as $rm)
                        @if ($rm->room_id == $room->id)
                            @if ($rm->status == 1)
                            <img src="{{ asset($rm->image) }}" class="card-img-top">
                            @endif
                        @endif
                    @endforeach
                    <div class="card-body">
                        <h5 class="mb-1">{{$room->name}}</h5>
                        <h6 class="mb-4">{{$room->price}} per night</h6>
                        <div class="features mb-4">
                            <h6 class="mb-1">Features</h6>
                            @foreach ($room->features as $feature)
                            <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                {{ $feature->feature->name }}</span>
                                
                            @endforeach
                        </div>
                        <div class="facilities mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            @foreach ($room->facilities as $facility)
                            <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                {{ $facility->facility->name }}</span>
                                
                            @endforeach
                        </div>
                        <div class="guests mb-4">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                {{$room->adult}} Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                {{$room->children}} Children
                            </span>
                        </div>
                        <div class="rating mb-4">
                            <h6 class="mb-1">Rating</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-evenly mb-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                            <a href="{{route('rooms.details',$room->id)}}" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
                        </div>
                    </div>
                </div>
            </div>    
            @endforeach


        </div>
        <div class="col-lg-12 text-center mt-5">
            <a href="{{route('room.index')}}" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
        </div>
    </div>
    <!-- Our Rooms end -->

   
<!-- Our Facility Start -->

<h2 class="mt-5 pt-4 text-center fw-bold h-font">OUR FACILITIES</h2>

<div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">

        <!-- Facility Item -->
        @foreach ($facilities as $facilitie)
        <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-4">
            <img src="{{asset($facilitie->icon_path)}}" width="80px">
            <h5 class="mt-3">{{$facilitie->name}}</h5>
        </div>
        @endforeach

        <!-- More Facilities Button -->
        <div class="col-lg-12 text-center mt-5">
            <a href="{{route('facilities.index')}}" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities >>></a>
        </div>    
    </div>
</div>
<!-- Our Facility End -->


<!-- Testimonials -->
<h2 class="mt-5 pt-4 text-center fw-bold h-font">TESTIMONIALS</h2>

<div class="container">
    <!-- Testimonials Swiper -->
    <div class="swiper swiper-testimonials">
        <div class="swiper-wrapper mb-5">

            <!-- Testimonial Slide 1 -->
            <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-3">
                    <img src="images/facilities/star.svg" width="30px">
                    <h6 class="m-0 ms-2">Random User 1</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit cupiditate voluptatum omnis dolores? Voluptates, voluptatem?</p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>

            <!-- Testimonial Slide 2 -->
            <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-3">
                    <img src="images/facilities/star.svg" width="30px">
                    <h6 class="m-0 ms-2">Random User 2</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit cupiditate voluptatum omnis dolores? Voluptates, voluptatem?</p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>

            <!-- Testimonial Slide 3 -->
            <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-3">
                    <img src="images/facilities/star.svg" width="30px">
                    <h6 class="m-0 ms-2">Random User 3</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit cupiditate voluptatum omnis dolores? Voluptates, voluptatem?</p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>

            <!-- Testimonial Slide 4 -->
            <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-3">
                    <img src="images/facilities/star.svg" width="30px">
                    <h6 class="m-0 ms-2">Random User 4</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit cupiditate voluptatum omnis dolores? Voluptates, voluptatem?</p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>

            <!-- Testimonial Slide 5 -->
            <div class="swiper-slide bg-white p-4">
                <div class="profile d-flex align-items-center mb-3">
                    <img src="images/facilities/star.svg" width="30px">
                    <h6 class="m-0 ms-2">Random User 5</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit cupiditate voluptatum omnis dolores? Voluptates, voluptatem?</p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>

        </div>
        <!-- Swiper Pagination -->
        <div class="swiper-pagination"></div>
    </div>

    <!-- Know More Button -->
    <div class="col-lg-12 text-center mt-5">
        <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More >>></a>
    </div>
</div>

<!-- reach us start -->
<h2 class="mt-5 pt-4 text-center fw-bold h-font">REACH US</h2>

<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
        {!! $contacts->iframe !!}
    </div>

    <div class="col-lg-4 col-md-4">
      <div class="bg-white p-4 rounded mb-4">
        <h5>Call us</h5>
        <a href="tel:+your_phone_number_1" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-telephone-fill"></i> +977{{$contacts->pn1}}
        </a>
        <br>
        <a href="tel:+your_phone_number_2" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-telephone-fill"></i> +977{{$contacts->pn2}}
        </a>
      </div>

      <div class="bg-white p-4 rounded mb-4">
        <h5>Follow us</h5>  
        <a href="{{$contacts->tw}}" class="d-inline-block mb-3" target="_blank">
          <span class="badge bg-light text-dark fs-6 p-2">
            <i class="bi bi-twitter me-1"></i>Twitter
          </span>
        </a>
        <br>
        <a href="{{$contacts->fb}}" class="d-inline-block mb-3" target="_blank">
          <span class="badge bg-light text-dark fs-6 p-2">
            <i class="bi bi-facebook me-1"></i>Facebook
          </span>
        </a>
        <br>
        <a href="{{$contacts->insta}}" class="d-inline-block" target="_blank">
          <span class="badge bg-light text-dark fs-6 p-2">
            <i class="bi bi-instagram me-1"></i>Instagram
          </span>
        </a>
      </div>
    </div>
  </div>
</div>
<!-- reach us end -->



@endsection
