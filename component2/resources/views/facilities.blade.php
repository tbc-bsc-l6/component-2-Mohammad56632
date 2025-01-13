@extends('inc.layout')
@section('title','facilities')

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
  
      <!-- Facility Data Loop Start -->
      @foreach ($facilities as $f)
      <div class="col-lg-4 col-md-6 mb-5 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-dark pop">
          <div class="d-flex align-items-center mb-2">
            <img src="{{asset($f->icon_path)}}" width="40px">
            <h5 class="m-0 ms-3">{{$f->name}}</h5>
          </div>
          <p>{{$f->description}}</p>
        </div>
      </div>
      @endforeach

      <!-- Facility Data Loop End -->
  
    </div>
  </div>
  
@endsection