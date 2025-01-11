@extends('admin.dashboard')

@section('content')
    <h3 class="mb-4">SETTINGS</h3>

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

    <!-- General Settings Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title m-0">General Settings </h5>
                <!-- Edit Button -->
                <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                    <i class="bi bi-pencil-square"></i> Edit
                </button>
            </div>
            
            <!-- Site Title -->
            <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
            <p class="card-text" id="site_title">{{ $generalSettings->sitetitle }}</p>

            <!-- About Us -->
            <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
            <p class="card-text" id="site_about">{{ $generalSettings->aboutus }} </p>
        </div>
    </div>

    <!-- General Settings Modal -->
    <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" id="general_s_form" action="{{ route('general.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">General Settings</h5>
                    </div>
                    <div class="modal-body">
                        <!-- Site Title Input -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Site Title</label>
                            <input type="text" name="sitetitle" id="site_title_inp"
                                class="form-control shadow-none @error('sitetitle') is-invalid @else is-valid @enderror"
                                value="{{ old('sitetitle', $generalSettings->sitetitle) }}">
                            @error('sitetitle')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <!-- About Us Textarea -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">About Us</label>
                            <textarea name="aboutus" id="site_about_inp" 
                                class="form-control shadow-none @error('aboutus') is-invalid @else is-valid @enderror" 
                                rows="6" style="resize: none;">{{ old('aboutus', $generalSettings->aboutus) }}</textarea>
                            @error('aboutus')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Shutdown Website Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title m-0">Shutdown Website</h5>
                <!-- Toggle for shutdown -->
                <div class="form-check form-switch">
                    <form method="post">
                        <input onchange="upd_shutdown(this.value)"
                               class="form-check-input shadow-none mt-4 fw-bold" type="checkbox" id="shutdown_toggle">
                    </form>
                </div>
            </div>
            <p class="card-text">
                No customers will be allowed to book hotel rooms when the shutdown mode is turned on.
            </p>
        </div>
    </div>

            <!-- Contact Section Start -->
<div class="card border-0 shadown-sm mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">Contacts Settings</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contacts-s">
                <i class="bi bi-pencil-square"></i> Edit
            </button>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                    <p class="card-text" id="address">{{$contactdetails->address}}</p>
                </div>
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                    <p class="card-text" id="gmap">{{$contactdetails->gmap}}</p>
                </div>
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold"></h6>
                    <p class="card-text mb-1">
                        <i class="bi bi-telephone-fill"></i>
                        <span id="pn1">{{$contactdetails->pn1}}</span>
                    </p>
                    <p class="card-text">
                        <i class="bi bi-telephone-fill"></i>
                        <span id="pn2">{{$contactdetails->pn2}}</span>
                    </p>
                </div>
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">E-mail</h6>
                    <p class="card-text" id="email">{{$contactdetails->email}}</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                    <p class="card-text">
                        <i class="bi bi-facebook me-1"></i>
                        <span id="fb">{{$contactdetails->fb}}</span>
                    </p>
                    <p class="card-text">
                        <i class="bi bi-instagram me-1"></i>
                        <span id="insta">{{$contactdetails->insta}}</span>
                    </p>
                    <p class="card-text">
                        <i class="bi bi-twitter me-1"></i>
                        <span id="tw">{{$contactdetails->tw}}</span>
                    </p>
                </div>
                <div class="mb-4">
                    <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                    <div class="border p-2 w-100">
                        {!! $contactdetails->iframe !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contacts Modal -->
<div class="modal fade modal-lg" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" id="contacts_s_form" action="{{ route('contact.details.update') }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Contact Settings</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Address</label>
                                    <input type="text" name="address" id="address_inp" class="form-control shadow-none" value="{{ old('address', $contactdetails->address) }}" required>
                                    @error('address')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Google Map Link</label>
                                    <input type="text" name="gmap" id="gmap_inp" class="form-control shadow-none" value="{{ old('gmap', $contactdetails->gmap) }}">
                                    @error('gmap')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Phone Numbers (with country code)</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                        <input type="number" name="pn1" id="pn1_inp" class="form-control shadow-none" value="{{ old('pn1', $contactdetails->pn1) }}">
                                        @error('pn1')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                        <input type="number" name="pn2" id="pn2_inp" class="form-control shadow-none" value="{{ old('pn2', $contactdetails->pn2) }}">
                                        @error('pn2')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" id="email_inp" class="form-control shadow-none" value="{{ old('email', $contactdetails->email) }}" required>
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Social Links</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                        <input type="text" name="fb" id="fb_inp" class="form-control shadow-none" value="{{ old('fb', $contactdetails->fb) }}">
                                        @error('fb')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                        <input type="text" name="insta" id="insta_inp" class="form-control shadow-none" value="{{ old('insta', $contactdetails->insta) }}">
                                        @error('insta')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                        <input type="text" name="tw" id="tw_inp" class="form-control shadow-none" value="{{ old('tw', $contactdetails->tw) }}">
                                        @error('tw')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">iFrame</label>
                                    <textarea name="iframe" id="iframe_inp" class="form-control shadow-none" rows="6" style="resize: none;">{{ old('iframe', $contactdetails->iframe) }}</textarea>
                                    @error('iframe')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="contacts_inp(contacts_data)" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Management Section Start -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h5 class="card-title m-0">Management Team</h5>
            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#team-s">
                <i class="bi bi-plus-square"></i> Add
            </button>
        </div>
        <div class="row" id="team-data">
            @foreach ($team as $teams)
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-dark">
                        <img src="{{ asset($teams->image) }}" class="card-img w-100">
                        <div class="card-img-overlay text-end">
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-warning btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#editModal{{ $teams->id }}">
                                <i class="bi bi-pencil"></i> Edit
                            </button>

                            <!-- Delete Button -->
                            <form method="POST" action="{{ route('team.management.destroy', $teams->id) }}" class="delete-form" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm shadow-none">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                            <script>
                                document.querySelectorAll('.delete-form').forEach(function (form) {
                                    form.addEventListener('submit', function (event) {
                                        if (!confirm('Are you sure you want to delete this team member?')) {
                                            event.preventDefault();
                                        }
                                    });
                                });
                            </script>

                            <!-- Active/Inactive Toggle Button -->
                            <form method="POST" action="{{ route('team.management.toggleStatus', $teams->id) }}" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-{{ $teams->status ? 'success' : 'secondary' }} btn-sm shadow-none">
                                    {{ $teams->status ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                        </div>
                        <h3 class="text-center">{{$teams->name}}</h3>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $teams->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $teams->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="{{ route('team.management.update', $teams->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Team Member</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ $teams->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Image</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">UPDATE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>    
@endsection