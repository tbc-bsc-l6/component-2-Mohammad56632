@extends('inc.layout')
@section('title', 'rooms')
@section('content')
<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR Rooms</h2>
    <div class="h-line bg-dark"></div>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Filters Section -->
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
                            <input type="date" id="check_in" class="form-control shadow-none mb-3" min="{{ date('Y-m-d') }}">
                            <label class="form-label">Check-out</label>
                            <input type="date" id="check_out" class="form-control shadow-none" min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                        </div>

                        <div class="border bg-light p-3 rounded mb-3">
                            <h5 class="mb-3" style="font-size: 18px">FACILITIES</h5>
                            @foreach ($facilities as $f)
                            <div class="mb-2">
                                <input type="checkbox" class="form-check-input shadow-none me-1 facilities-checkbox" value="{{ $f->id }}">
                                <label class="form-label">{{ $f->name }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="border bg-light p-3 rounded mb-3">
                            <h5 class="mb-3" style="font-size: 18px">GUESTS</h5>
                            <div class="d-flex">
                                <div class="me-3">
                                    <label class="form-label">Adults</label>
                                    <input type="number" id="adults" class="form-control shadow-none" min="1" value="1">
                                </div>
                                <div>
                                    <label class="form-label">Children</label>
                                    <input type="number" id="children" class="form-control shadow-none" min="0" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Room Display Section -->
        <div class="col-lg-9 col-md-12 px-4">
            <div id="selected-facilities" class="mb-4"></div> <!-- Display selected facilities -->
            <div id="room-list">
                @include('partials.rooms_list', ['rooms' => $rooms, 'roomImage' => $roomImage])
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filters = {
            check_in: document.getElementById('check_in'),
            check_out: document.getElementById('check_out'),
            adults: document.getElementById('adults'),
            children: document.getElementById('children'),
            facilities: document.querySelectorAll('.facilities-checkbox'),
        };

        // Attach event listeners
        for (const key in filters) {
            if (key === 'facilities') {
                filters[key].forEach(checkbox => checkbox.addEventListener('change', filterRooms));
            } else {
                filters[key].addEventListener('input', filterRooms);
            }
        }

        // AJAX Request to Fetch Filtered Rooms
        function filterRooms() {
            const facilities = Array.from(filters.facilities)
                .filter(facility => facility.checked)
                .map(facility => ({
                    id: facility.value,
                    name: facility.nextElementSibling.textContent.trim(),
                }));

            const selectedFacilitiesHtml = facilities
                .map(f => `<span class="badge rounded-pill bg-light text-dark me-2">${f.name}</span>`)
                .join('');
            document.getElementById('selected-facilities').innerHTML = selectedFacilitiesHtml;

            const data = {
                check_in: filters.check_in.value,
                check_out: filters.check_out.value,
                adults: filters.adults.value,
                children: filters.children.value,
                facilities: facilities.map(f => f.id),
            };

            fetch("{{ route('rooms.filter') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('room-list').innerHTML = data.rooms;
            })
            .catch(error => console.error('Error fetching rooms:', error));
        }
    });
</script>
@endsection
