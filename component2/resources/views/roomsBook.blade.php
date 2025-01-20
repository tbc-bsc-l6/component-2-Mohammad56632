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
        </div>
        <!-- Room Details Section -->
        <div class="col-lg-5 col-md-12 px-4">
            <div class="card mb-4 border-0 shadow-sm rounded-3">
                <div class="card-body">
                    
                    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                    <form method="POST" action="{{route('room.book.store',$roomdetails->id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('user_name') is-invalid @else is-valid @enderror" name="user_name" value="{{ old('user_name') }}">
                                    @error('user_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="number"  class="form-control @error('user_phone') is-invalid @else is-valid @enderror" id="phone" name="user_phone" value="{{ old('user_phone') }}">
                                    @error('user_phone')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                  </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('user_address') is-invalid @else is-valid @enderror" name="user_address" id="address" value="{{ old('user_address') }}">
                                    @error('user_address')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                  </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="check_in" class="form-label">Checked In</label>
                                    <input type="date" class="form-control @error('check_in') is-invalid @else is-valid @enderror" id="check_in" name="check_in" value="{{ old('check_in') }}">
                                    @error('check_in')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                  </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="check_out" class="form-label">checked out</label>
                                    <input type="date" id="check_out" class="form-control @error('check_out') is-invalid @else is-valid @enderror" name="check_out" value="{{ old('check_out') }}">
                                    @error('check_out')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                  </div>
                            </div>

                        </div>
                        <button type="submit" class="btn w-100 text-white custom-bg btn-success shadow-none mb-3">Book Now</button>
                      </form>

                    <!-- Booking Button -->
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
@endsection
