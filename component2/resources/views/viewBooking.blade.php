@extends('inc.layout')
@section('title','rooms')
@section('content')
<div class="page-content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="container my-4">
                <div class="row">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @foreach ($bookingDetails as $bd)
                        @if ($bd->user_id == Auth::user()->id)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card shadow-sm border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $bd->room->name ?? 'N/A' }}</h5>
                                        <p class="card-text">
                                            Name: {{ $bd->user_name }}<br>
                                            Phone: {{ $bd->user_phone }}<br>
                                            Address: {{ $bd->user_address }}<br>
                                            Checked In: {{ $bd->check_in }}<br>
                                            Checked Out: {{ $bd->check_out }}
                                        </p>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal-{{ $bd->id }}">Review</button>
                                            <form method="POST" action="{{ route('booking.destroy', $bd->id) }}" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?');">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Review Modal -->
                            <div class="modal fade @if ($errors->any() && session('room_id') == $bd->room->id) show @endif" 
                                 id="reviewModal-{{ $bd->id }}" 
                                 tabindex="-1" 
                                 aria-labelledby="reviewModalLabel" 
                                 aria-hidden="true"
                                 style="@if ($errors->any() && session('room_id') == $bd->room->id) display: block; @endif">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reviewModalLabel">Leave a Review</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('review.store', $bd->room->id) }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <h5 class="card-title">{{ $bd->room->name ?? 'N/A' }}</h5>

                                                    <label for="rating" class="form-label">Rating</label>
                                                    <div id="rating" class="d-flex gap-1">
                                                        <input type="number" name="rating" id="ratingInput" value="{{ old('rating') }}">
                                                        @error('rating')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Description</label>
                                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Write your review here...">{{ old('description') }}</textarea>
                                                    @error('description')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-success">Submit Review</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="div_design">
                {{-- {{$product->onEachSide(1)->links()}} --}}
            </div>
        </div>
    </div>
</div>
@endsection
