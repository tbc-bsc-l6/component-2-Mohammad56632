@extends('inc.layout')
@section('title','contact us')
@section('content')
<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
      Lorem ipsum, dolor sit amet consectetur
      adipisicing elit. A perspiciatis unde recusandae,<br> quo expedita
      molestias illum ullam! Animi, sequi! Tenetur.
    </p>
  </div>
  
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 mb-5 px-4">
        <div class="bg-white rounded shadow p-4">
          {!! $cd->iframe !!}
          <h5>Address</h5>
          <a href="your_gmap_link_here" target="_blank" class="d-inline-block text-decoration-none mb-2 text-dark">
            <i class="bi bi-geo-alt-fill me-1"></i>
            {{$cd->address}}
          </a>
          <h5 class="mt-4">Call us</h5>
          <a href="tel: +your_phone_number_1" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill">+977{{$cd->pn1}}</i>
          </a>
          <br>
          <a href="tel: +your_phone_number_2" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill">+977{{$cd->pn2}}</i>
          </a>
          <h5 class="mt-4">Email</h5>
          <a href="mailto:your_email_here" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-envelope-arrow-up-fill me-1"></i>{{$cd->email}}
          </a>
        </div>
      </div>
  
      <div class="col-lg-6 col-md-6 mb-5 px-4">
        <div class="bg-white rounded shadow p-4">
          <form action="{{route('user.query.store')}}" method="post">
            @csrf

            <h5>Send a message</h5>
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
            <div class="mb-3">
              <label class="form-label" style="font-weight: 500;">Name</label>
              <input type="text" name="name" class="form-control shadow-none @error('name') is-invalid @enderror">
              @error('name')
              <span class="text-danger">{{$message}}</span>

              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" style="font-weight: 500;">Email</label>
              <input type="email" name="email" class="form-control shadow-none @error('email') is-invalid @enderror">
              @error('email')
              <span class="text-danger">{{$message}}</span>

              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" style="font-weight: 500;">Subject</label>
              <input type="text" name="subject"  class="form-control shadow-none @error('subject') is-invalid @enderror">
              @error('subject')
              <span class="text-danger">{{$message}}</span>

              @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" style="font-weight: 500;">Message</label>
              <textarea name="message"  class="form-control shadow-none @error('message') is-invalid @enderror" rows="5" style="resize:none;"></textarea>

              @error('message')
              <span class="text-danger">{{$message}}</span>

              @enderror
            </div>
            <button type="submit" name="send" class="btn text-white custom-bg mt-3">SEND</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
@endsection