@extends('inc.layout')
@section('title','rooms')
@section('content')
<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR Rooms</h2>
    <div class="h-line bg-dark"></div>
  </div>
  
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 px-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
          <div class="container-fluid flex-lg-column align-items-stretch">
            <h4 class="m-2">FILTERS</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
              data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size: 18px">CHECK AVAILABILITY</h5>
                <label class="form-label">Check-in</label>
                <input type="date" class="form-control shadow-none mb-3">
                <label class="form-label">Check-out</label>
                <input type="date" class="form-control shadow-none">
              </div>
  
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size: 18px">FACILITIES</h5>
                <div class="mb-2">
                  <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
                  <label class="form-label" for="f1">Facility one</label>
                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f2" class="form-check-input shadow-none me-1">
                  <label class="form-label" for="f2">Facility two</label>
                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f3" class="form-check-input shadow-none me-1">
                  <label class="form-label" for="f3">Facility three</label>
                </div>
              </div>
  
              <div class="border bg-light p-3 rounded mb-3">
                <h5 class="mb-3" style="font-size: 18px">GUESTS</h5>
                <div class="d-flex">
                  <div class="me-3">
                    <label class="form-label">Adults</label>
                    <input type="number" class="form-control shadow-none">
                  </div>
                  <div>
                    <label class="form-label">Children</label>
                    <input type="number" class="form-control shadow-none">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
      
      <div class="col-lg-9 col-md-12 px-4">
        @foreach ($rooms as $room)

        <!-- Room Data Loop Start -->
        <div class="card mb-4 border-0 shadow">
          <div class="row g-0 p-3 align-items-center">
            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
              @foreach ($roomImage as $rm)
                  @if ($room->id == $rm->room_id)
                      @if ($rm->status == 1)
                      <img src="{{ asset($rm->image) }}" class="img-fluid rounded">
                      @endif
                  @endif
              @endforeach
            </div>
            <div class="col-md-5 px-lg-3 px-md-3 px-0">
              <h5 class="mb-1">{{$room->name}}</h5>
        <!-- Features Section -->
        <div class="features mb-3">
          <h6 class="mb-3">Features</h6>
          @if ($room->features->isNotEmpty())
              @foreach ($room->features as $feature)
                  <span class='badge rounded-pill bg-light text-dark text-wrap'>
                      {{ $feature->feature->name }}
                  </span>
              @endforeach
          @else
              <span class='text-muted'>No features available</span>
          @endif
      </div>
        <!-- Facilities Section -->
        <div class="facilities mb-3">
          <h6 class="mb-1">Facilities</h6>
          @if ($room->facilities->isNotEmpty())
              @foreach ($room->facilities as $facility)
                  <span class='badge rounded-pill bg-light text-dark text-wrap'>
                      {{ $facility->facility->name }}
                  </span>
              @endforeach
          @else
              <span class='text-muted'>No facilities available</span>
          @endif
      </div>
              <div class="guests">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  {{$room->adult}} Adults
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  {{$room->children}} Child
                </span>
              </div>
            </div>
            <div class="col-md-2 text-center">
              <h6 class="mb-4">${{$room->price}} per night</h6>
              <a href="{{route('rooms.book',$room->id)}}" class="btn btn-sm text-white custom-bg shadow-none mb-2">Book Now</a>
              <a href="{{route('rooms.details',$room->id)}}" class="btn btn-sm btn-outline-dark shadow-none bg-dark text-white">More details</a>
            </div>
          </div>
        </div>
        <!-- Room Data Loop End -->
        @endforeach

      </div>

    </div>
  </div>
  
@endsection