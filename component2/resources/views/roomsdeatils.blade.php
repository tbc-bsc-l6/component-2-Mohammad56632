@extends('inc.layout')
@section('title', 'Room Details')
@section('content')

<div class="container">
    <div class="col-12 my-5 px-4">
        <h2 class="fw-bold">{{ $roomdetails->name }}</h2>
        <div style="font-size:14px">
            <a href="{{ url('/') }}" class="text-secondary text-decoration-none">HOME</a>
            <span class="text-secondary"> || </span>
            <a href="{{ route('room.index') }}" class="text-secondary text-decoration-none">ROOMS</a>
            <span class="text-secondary"> || </span>
            <span class="text-dark">{{ $roomdetails->name }}</span>
        </div>
    </div>

    <div class="row">
        <!-- Carousel Section -->
        <div class="col-lg-7 col-md-12 px-4">
            <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($roomImages as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset($image->image) }}" class="d-block w-100 rounded" alt="Room Image">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        
        

        <!-- Room Details Section -->
        <div class="col-lg-5 col-md-12 px-4">
            <div class="card mb-4 border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h4>${{ $roomdetails->price }} per night</h4>
                    <div class="mb-3">
                        @for ($i = 0; $i < $roomdetails->rating; $i++)
                            <i class="bi bi-star-fill text-warning"></i>
                        @endfor
                    </div>

                    <!-- Features Section -->
                    <div class="mb-3">
                        <h6 class="mb-1">Features</h6>
                        @foreach ($roomdetails->features as $feature)
                            <span class="badge rounded-pill bg-light text-dark text-wrap me-1 mb-1">
                                {{ $feature->feature->name }}
                            </span>
                        @endforeach
                    </div>

                    <!-- Facilities Section -->
                    <div class="mb-3">
                        <h6 class="mb-1">Facilities</h6>
                        @foreach ($roomdetails->facilities as $facility)
                            <span class="badge rounded-pill bg-light text-dark text-wrap me-1 mb-1">
                                {{ $facility->facility->name }}
                            </span>
                        @endforeach
                    </div>

                    <!-- Guests Section -->
                    <div class="mb-3">
                        <h6 class="mb-1">Guests</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap me-1 mb-1">
                            {{ $roomdetails->max_adults }} Adults
                        </span>
                        <span class="badge rounded-pill bg-light text-dark text-wrap me-1 mb-1">
                            {{ $roomdetails->max_children }} Children
                        </span>
                    </div>

                    <!-- Area Section -->
                    <div class="mb-3">
                        <h6 class="mb-1">Area</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap me-1 mb-1">
                            {{ $roomdetails->area }} sq ft
                        </span>
                    </div>

                    <!-- Booking Button -->
                    <a href="#" class="btn w-100 text-white custom-bg shadow-none mb-3">Book Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    <div class="col-12 mt-4 px-4">
        <div class="mb-5">
            <h5 class="fw-bold">Description</h5>
            <p>{{ $roomdetails->description }}</p>
        </div>

        <!-- Reviews Section -->
        <div>
            <h5 class="mb-3">Reviews & Ratings</h5>
            <div class="profile d-flex align-items-center mb-3">
                <img src="images/facilities/star.svg" width="30px">
                <h6 class="m-0 ms-2">Random user1</h6>
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
</div>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
