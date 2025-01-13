@extends('inc.layout')
@section('title', 'User Profile')
@section('content')

<div class="container py-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">User Profile</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">ID:</div>
                <div class="col-md-8">{{ Auth::user()->id }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Name:</div>
                <div class="col-md-8">{{ Auth::user()->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Phone:</div>
                <div class="col-md-8">{{ Auth::user()->phone }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Email:</div>
                <div class="col-md-8">{{ Auth::user()->email }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Address:</div>
                <div class="col-md-8">{{ Auth::user()->address }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Gender:</div>
                <div class="col-md-8">{{ Auth::user()->gender }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Profile:</div>
                <div class="col-md-8">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset(Auth::user()->profile) }}" class="card-img-top" alt="...">
                      </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Role:</div>
                <div class="col-md-8">
                    {{ Auth::user()->role == 1 ? 'User' : 'Admin' }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Date of Birth:</div>
                <div class="col-md-8">{{ Auth::user()->dob }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Status:</div>
                <div class="col-md-8">
                    {{ Auth::user()->status == 1 ? 'Active' : 'Inactive' }}
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 font-weight-bold">Created At:</div>
                <div class="col-md-8">{{ Auth::user()->created_at->format('d M, Y h:i A') }}</div>
            </div>
        </div>
    </div>
</div>

@endsection
