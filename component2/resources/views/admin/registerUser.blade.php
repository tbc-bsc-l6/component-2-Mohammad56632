@extends('admin.dashboard')
@section('title','User Register')
@section('content')
    <h2 class="mt-3">Register Users Management</h2>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">phone</th>
            <th scope="col">Gender</th>
            <th scope="col">Register_Date</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>

            
          </tr>
        </thead>
        <tbody>

            @foreach ($registerUser as $ru)
    @if ($ru->role == 1)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ru->name }}</td>
            <td>{{ $ru->email }}</td>
            <td>{{ $ru->phone }}</td>
            <td>{{ $ru->gender }}</td>
            <td>{{ $ru->created_at }}</td>
            <td>
                <button class="btn btn-sm btn-success">
                    <i class="bi bi-person"></i> User
                </button>
            </td>
            <td>
                @if ($ru->status == 1)
                    <button class="btn btn-sm btn-info">
                        <i class="bi bi-check-circle"></i> Active
                    </button>
                @else
                    <button class="btn btn-sm btn-secondary">
                        <i class="bi bi-x-circle"></i> Inactive
                    </button>
                @endif

                <form action="{{ route('user.updateStatus', $ru->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">
                        @if ($ru->status == 1)
                            <i class="bi bi-lock"></i> Block
                        @else
                            <i class="bi bi-unlock"></i> Unblock
                        @endif
                    </button>
                </form>
            </td>
        </tr>
    @endif
@endforeach

         
        </tbody>
      </table>

<!-- Pagination Links -->
<div class="d-flex justify-content-center">
    {{ $registerUser->links() }}
</div>
@endsection