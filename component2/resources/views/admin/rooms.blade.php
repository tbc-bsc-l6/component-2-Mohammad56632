@extends('admin.dashboard')
@section('title','Rooms')
@section('content')
    
                <h3 class="mb-4">Rooms</h3>
{{-- @foreach ($r_facilities as $rf)
    <h1>
        {{$rf->facility_id}}
        {{ $rf->facility->name}}
    </h1>
@endforeach
@foreach($r_features as $rf)
<span class="badge bg-info">{{ $rf->feature->name }}</span>
@endforeach --}}

                    <!-- Success message display -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Error message display -->
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
                <!-- feature card section start -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">

                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                                data-bs-target="#add-room">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="table-responsive-lg" style="height:450; overflow-y:scroll;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Guest</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rooms as $room)
                                    <tr class="align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->area }} sq. ft.</td>
                                        <td>
                                            <span class="badge rounded-pill bg-light text-dark">Adult: {{ $room->adult }}</span>
                                            <br>
                                            <span class="badge rounded-pill bg-light text-dark">Children: {{ $room->children }}</span>
                                        </td>
                                        <td>{{ $room->price }}</td>
                                        <td>{{ $room->quantity }}</td>
                                    
                                        <td>
                                            <form action="" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn {{ $room->status == 1 ? 'btn-success' : 'btn-danger' }} btn-sm shadow-none">
                                                    {{ $room->status == 1 ? 'Active' : 'Inactive' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-info shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#edit-room{{$room->id}}">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </button>
                                            <a href="" class="btn btn-primary shadow-none btn-sm">
                                                <i class="bi bi-images"></i>
                                            </a>
                                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger shadow-none btn-sm">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    
                                    <!-- Edit Room Modal -->
                                    <div class="modal fade" id="edit-room{{$room->id}}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <form action="{{ route('rooms.update', $room->id) }}" method="POST" id="edit_room_form" autocomplete="off">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Room</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold">Name</label>
                                                                <input type="text" name="name" class="form-control shadow-none" value="{{ $room->name }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold">Area</label>
                                                                <input type="number" min="1" name="area" class="form-control shadow-none" value="{{ $room->area }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold">Price</label>
                                                                <input type="number" name="price" class="form-control shadow-none" value="{{ $room->price }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold">Quantity</label>
                                                                <input type="number" min="1" name="quantity" class="form-control shadow-none" value="{{ $room->quantity }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold">Adult (Max.)</label>
                                                                <input type="number" min="1" name="adult" class="form-control shadow-none" value="{{ $room->adult }}" required>
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label fw-bold">Children (Max.)</label>
                                                                <input type="number" min="1" name="children" class="form-control shadow-none" value="{{ $room->children }}" required>
                                                            </div>
                                                            
                                                            <!-- Features -->
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label fw-bold">Features</label>
                                                                <div class="row">
                                                                    @foreach ($feature as $features)
                                                                    <div class="col-md-3 mb-1">
                                                                        <input type="checkbox" name="features[]" value="{{ $features->id }}"
                                                                        class="form-check-input me-1 shadow-none"
                                                                        {{ in_array($features->id, $room->features->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                                    {{ $features->name }}
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                    
                                                            <!-- Facilities -->
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">Facility</label>
                            <div class="row">
                                @foreach ($facilitie as $facilities)
                                <div class="col-md-3 mb-1">
                                    <label>
                                        <input type="checkbox" name="facilities[]" value="{{ $facilities->id }}"
                                            class="form-check-input me-1 shadow-none"
                                            {{ in_array($facilities->id, $room->facilities->pluck('id')->toArray()) ? 'checked' : '' }}>
                                        {{ $facilities->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                                    
                                                            <!-- Description -->
                                                            <div class="col-12 mb-3">
                                                                <label class="form-label fw-bold">Description</label>
                                                                <textarea name="desc" rows="4" class="form-control shadow-none" style="resize:none;" required>{{ $room->description }}</textarea>
                                                            </div>
                                    
                                                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                                        <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            
                            
                            
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <!--add room Modal -->
    <div class="modal fade" id="add-room" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" autocomplete="off" action="{{ route('rooms.store') }}">
                @csrf
            
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Room</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Area</label>
                                <input type="number" min="1" name="area" class="form-control shadow-none" value="{{ old('area') }}" required>
                                @error('area')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Price</label>
                                <input type="number" name="price" class="form-control shadow-none" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Quantity</label>
                                <input type="number" min="1" name="quantity" class="form-control shadow-none" value="{{ old('quantity') }}" required>
                                @error('quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Adult (Max.)</label>
                                <input type="number" min="1" name="adult" class="form-control shadow-none" value="{{ old('adult') }}" required>
                                @error('adult')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Children (Max.)</label>
                                <input type="number" min="1" name="children" class="form-control shadow-none" value="{{ old('children') }}" required>
                                @error('children')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">
                                    @foreach ($feature as $features)
                                        <div class="col-md-3 mb-1">
                                            <label>
                                                <input type="checkbox" name="features[]" value="{{ $features->id }}" class="form-check-input me-1 shadow-none">
                                                {{ $features->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('features')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facility</label>
                                <div class="row">
                                    @foreach ($facilitie as $facilities)
                                        <div class="col-md-3 mb-1">
                                            <label>
                                                <input type="checkbox" name="facilities[]" value="{{ $facilities->id }}" class="form-check-input me-1 shadow-none">
                                                {{ $facilities->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                @error('facilities')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="desc" rows="4" class="form-control shadow-none" style="resize:none;" required>{{ old('desc') }}</textarea>
                                @error('desc')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>



    <!-- Manage room images modal -->
    <!-- Modal -->
    <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Room Name</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="border-buttom border-3 pb-3 mb-3">
                        <form id="add_image_form">
                            <label class="form-label fw-bold">Add Image</label>
                            <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg"
                                class="form-control shadow-none mb-3" required>

                            <button class="btn custom-bg text-white shadow-none">ADD</button>
                            <input type="hidden" name="room_id">

                        </form>
                    </div>
                    <div class="table-responsive-lg" style="height:350; overflow-y:scroll;">
                        <table class="table table-hover border text-center">
                            <thead>
                                <tr class="bg-dark text-light sticky-top">
                                    <th scope="col" width="60%">Image</th>
                                    <th scope="col">Thub</th>
                                    <th scope="col">Delete</th>

                                </tr>
                            </thead>
                            <tbody id="room-image-data">

                            </tbody>

                        </table>
                    </div>
                </div>
@endsection
