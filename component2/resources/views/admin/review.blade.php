@extends('admin.dashboard')
@section('title','User Review')
@section('content')
    <h3 class="text-bold text-dark mb-3">Reviews and Ratings</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Room Name</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Ratings</th>
                    <th scope="col">Review Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($review as $r)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $r->room->name }}</td>
                    <td>{{ $r->user->name }}</td>
                    <td>
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $r->review)
                                <span class="text-warning">&#9733;</span>
                            @else
                                <span class="text-muted">&#9733;</span>
                            @endif
                        @endfor
                    </td>
                    <td>{{ $r->description }}</td>
                    <td>{{ $r->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <form method="POST" action="{{ route('review.toggleStatus', $r->id) }}" style="display: inline-block;">
                            @csrf
                            @method('PATCH')
                            @if ($r->status == 0)
                                <button type="submit" class="btn btn-sm btn-warning">Deactivate</button>
                            @else
                                <button type="submit" class="btn btn-sm btn-success">Activate</button>

                            @endif
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
                <!-- Pagination -->
                <div class="mt-3">
                    {{ $review->links() }}
                </div>
    </div>
@endsection
