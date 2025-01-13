@extends('admin.dashboard')
@section('title','user queries')
    
@section('content')
    
               <h3 class="mb-4">User Queries</h3>

                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="table-responsive-md " style="height:450; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top bg-dark">
                                    <tr class=".bg-info text-light">
                                        <th scope="col">Sr No</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" width="20%">Subject</th>
                                        <th scope="col" width="20%">Message</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userQuery as $uq)
                                        
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$uq->name}}</td>
                                            <td>{{$uq->email}}</td>
                                            <td>{{$uq->subject}}</td>
                                            <td>{{$uq->message}}</td>
                                            <td>{{ $uq->created_at->format('M d, h:i A') }}</td>
                                            <td>

                                                @if ($uq->status == 0)
                                                    <button class="btn btn-sm  btn-info"><i class="bi bi-eye-fill me-1"></i>read</button>
                                                @else
                                                    <button class="btn btn-sm  btn-secondary"><i class="bi bi-eye-fill me-1"></i>unread</button>

                                                @endif
                                                <form action="{{route('user.query.delete',$uq->id)}}" method="post" class="d-inline-block">
                                                    @csrf

                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger shadow-none" onclick="return confirm('Are you sure you want to delete all user queries?')"
                                                    ><i class="bi bi-trash"></i>delete</button>
                                                </form>
                                            </td>
                                            
                                            </tr>
                                            @endforeach

                                </tbody>

                            </table>
                            <!-- Pagination Links -->
<div class="mt-3">
    {{ $userQuery->links() }}
</div>
                        </div>

                    </div>
@endsection 