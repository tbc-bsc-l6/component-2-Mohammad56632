@foreach ($rooms as $room)
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
            <p>{{ $room->description }}</p>
            <p>Price: ${{ $room->price }} per night</p>
        </div>
        <div class="col-md-2 text-center">
            <a href="{{ route('rooms.book', $room->id) }}" class="btn btn-sm text-white custom-bg shadow-none mb-2">Book Now</a>
        </div>
    </div>
</div>
@endforeach
@if ($rooms->isEmpty())
<p class="text-center">No rooms found matching your criteria.</p>
@endif
