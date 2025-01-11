@extends('admin.dashboard')
@section('title','features_facilities')
@section('content')

<h3 class="mb-4">Features & Facilities</h3>

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

<!-- Feature Card Section -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">Features</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#feature-s">
                <i class="bi bi-plus-square"></i> Add
            </button>
        </div>

        <!-- Feature Table -->
        <div class="table-responsive-md" style="height:350px; overflow-y:scroll;">
            <table class="table table-hover border">
                <thead class="bg-info text-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="features-data">
                    @foreach ($feature as $features)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $features->name }}</td>
                            <td>
                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('feature.destory', $features->id) }}" class="delete-form" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm shadow-none" onclick="return confirm('Are you sure you want to delete this feature?');">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Facility Card Section -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">Facilities</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#facility-s">
                <i class="bi bi-plus-square"></i> Add
            </button>
        </div>

        <!-- Facility Table -->
        <div class="table-responsive-md" style="height:350px; overflow-y:scroll;">
            <table class="table table-hover border">
                <thead class="bg-dark">
                    <tr class="text-light">
                        <th scope="col">#</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Name</th>
                        <th scope="col" width="40%">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="facilities-data">
                    @foreach ($facilitie as $facilities)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($facilities->icon_path) }}" width="100px"></td>
                            <td>{{ $facilities->name }}</td>
                            <td>{{ $facilities->description }}</td>
                            <td>
                                <!-- Edit Button -->
                                <button type="button" class="btn btn-primary btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#editModal{{ $facilities->id }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>

                                <!-- Delete Button -->
                                <form method="POST" action="{{ route('facilities.destory', $facilities->id) }}" class="delete-form" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm shadow-none" onclick="return confirm('Are you sure you want to delete this facility?');">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $facilities->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $facilities->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('facilities.update', $facilities->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $facilities->id }}">Edit Facility</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Facility Name -->
                                            <div class="mb-3">
                                                <label for="facility_name" class="form-label">Facility Name</label>
                                                <input type="text" name="facility_name" class="form-control" id="facility_name" value="{{ old('facility_name', $facilities->name) }}" required>
                                                @error('facility_name')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Facility Description -->
                                            <div class="mb-3">
                                                <label for="facility_desc" class="form-label">Description</label>
                                                <textarea name="facility_desc" class="form-control" id="facility_desc" rows="3" required>{{ old('facility_desc', $facilities->description) }}</textarea>
                                                @error('facility_desc')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <!-- Facility Icon -->
                                            <div class="mb-3">
                                                <label for="facility_icon" class="form-label">Icon</label>
                                                <input type="file" name="facility_icon" class="form-control" id="facility_icon" accept=".svg,.jpg,.jpeg,.png,.webp">
                                                <small class="text-muted">Leave blank if you don't want to change the icon.</small>
                                                @error('facility_icon')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success">Save Changes</button>
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

<!-- Add Feature Modal -->
<div class="modal fade" id="feature-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="feature_s_form" action="{{ route('features.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Feature</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="name" class="form-control shadow-none @error('name') is-invalid @else is-valid @enderror" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Add Facility Modal -->
<div class="modal fade" id="facility-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="facility_s_form" method="POST" action="{{ route('facilities.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Facility</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input type="text" name="facility_name" class="form-control shadow-none" value="{{ old('facility_name') }}" required>
                        @error('facility_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Icon</label>
                        <input type="file" name="facility_icon" accept=".svg" class="form-control shadow-none" required>
                        @error('facility_icon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="facility_desc" class="form-control shadow-none" rows="3" style="resize:none">{{ old('facility_desc') }}</textarea>
                        @error('facility_desc')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
