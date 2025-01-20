@extends('inc.layout')
@section('title','rooms')
@section('content')
<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR Rooms</h2>
    <div class="h-line bg-dark"></div>
</div>

<div class="container-fluid">
    <div class="row">
        @foreach ($rooms as $room)
        <div class="col-lg-12 col-md-12 px-4">
            <!-- Room Data Loop Start -->
            <div class="card mb-4 border-0 shadow">
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                        @foreach ($roomImage as $rm)
                            @if ($room->id == $rm->room_id && $rm->status == 1)
                                <img src="{{ asset($rm->image) }}" class="img-fluid rounded">
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                        <h5 class="mb-1">{{ $room->name }}</h5>
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
                                {{ $room->adult }} Adults
                            </span>
                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                {{ $room->children }} Child
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <h6 class="mb-4">${{ $room->price }} per night</h6>
                        <a href="{{ route('rooms.book', $room->id) }}" class="btn btn-sm text-white custom-bg shadow-none mb-2">Book Now</a>
                        <a href="{{ route('room.index',) }}" class="btn btn-sm btn-outline-dark shadow-none bg-dark text-white mb-2">Room</a>
                    </div>
                </div>
            </div>
            <!-- Room Data Loop End -->
        </div>
        <div class="col-lg-12 col-md-12 px-4">
            <h5 class="fw-bold">Description</h5>
            <p>{{ $room->description }}</p>
        </div>
        @endforeach

        <!-- Review Section -->
        <div class="col-lg-12 col-md-12 px-4">
            <h3 class="fw-bold mb-4">User Reviews</h3>
            @foreach ($review as $r)
                @if ($r->status == 1)
                <div class="card mb-4 border-0 shadow">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset($r->user->profile) }}" class="rounded-circle" width="40" height="40">
                            <h6 class="m-0 ms-3">{{ $r->user->name }}</h6>
                        </div>
                        <p class="mb-3">{{ $r->description }}</p>
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $r->review)
                                    <span class="text-warning">&#9733;</span>
                                @else
                                    <span class="text-muted">&#9733;</span>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

    </div>
</div>

@endsection
