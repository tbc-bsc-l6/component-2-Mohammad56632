@extends('admin.dashboard')
@section('title','carousel')
@section('content')

            <h3 class="mb-4">Carousel</h3>
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
            <!-- carousel section start -->
            <div class="card border-0 shadown-sm mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">Images</h5>
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                            data-bs-target="#carousel-s">
                            <i class="bi bi-plus-square"></i> Add
                        </button>
                    </div>
                    <div class="row" id="carousel-data">
                        @foreach ($carousel as $carousels)
                            
                        <div class="col-lg-4 mb-2">
                            <div class="card" style="width: 100%;">
                                <img src="{{asset($carousels->image)}}" class="card-img-top" alt="...">
                                <div class="card-body">


                            <!-- Delete Button -->
                            <form method="POST" action="{{ route('carousel.destroy', $carousels->id) }}" class="delete-form" style="display:inline;">
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
                            <form method="POST" action="{{ route('carousel.toggleStatus', $carousels->id) }}" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-{{ $carousels->status ? 'success' : 'secondary' }} btn-sm shadow-none">
                                    {{ $carousels->status ? 'Active' : 'Inactive' }}
                                </button>
                            </form>
                                </div>
                              </div>
                        </div>
                        @endforeach

                    </div>

                </div>
            </div>

            <!--carousel Modal -->
            <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="post" id="carousel_s_form" action="{{route('carousel.store')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add images</h5>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Picture</label>
                                    <input type="file" name="image" id="carousel_picture_inp"
                                        accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="member_name.value='',member_picture.value=''" class="btn text-secondary shadow-none"
                                    data-bs-dismiss="modal">CANCEL</button>
                                <button type="submit" class="btn custom-bg text-white shadow-none">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

@endsection