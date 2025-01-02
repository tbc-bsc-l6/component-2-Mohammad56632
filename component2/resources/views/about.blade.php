@extends('inc.layout')
@section('title','about')

@section('content')
<div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">ABOUT US</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
      Lorem ipsum, dolor sit amet consectetur
      adipisicing elit. A perspiciatis unde recusandae,<br> quo expedita
      molestias illum ullam! Animi, sequi! Tenetur.
    </p>
  </div>
  
  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
        <h3 class="mb-3">Lorem ipsum dolor sit</h3>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti accusantium fuga dolorum quis odio consectetur unde voluptate velit cupiditate fugiat.
        </p>
      </div>
      <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
        <img src="images/about/about.jpg" class="w-100">
      </div>
    </div>
  
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
            <img src="images/about/hotel.svg" class="w-100">
            <h4>100+ ROOMS</h4>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
            <img src="images/about/customers.svg" class="w-100">
            <h4>200+ CUSTOMERS</h4>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
            <img src="images/about/rating.svg" class="w-100">
            <h4>150+ REVIEWS</h4>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
            <img src="images/about/staff.svg" class="w-100">
            <h4>100+ STAFF</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">MANAGEMENT TEAM</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
      Lorem ipsum, dolor sit amet consectetur
      adipisicing elit. A perspiciatis unde recusandae,<br> quo expedita
      molestias illum ullam! Animi, sequi! Tenetur.
    </p>
  </div>
  
  <div class="container px-4">
    <!-- Swiper -->
    <div class="swiper mySwiper">
      <div class="swiper-wrapper mb-5">
        <!-- Loop through team members -->
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
          <img src="{{asset('images/rooms/1.jpg')}}" class="w-100">
          <h5 class="mt-2">Your Name Here</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
            <img src="{{asset('images/rooms/2.jpg')}}" class="w-100">
            <h5 class="mt-2">Your Name Here</h5>
        </div>
        <div class="swiper-slide bg-white text-center overflow-hidden rounded">
            <img src="{{asset('images/rooms/1.jpg')}}" class="w-100">
            <h5 class="mt-2">Your Name Here</h5>
          </div>
          <div class="swiper-slide bg-white text-center overflow-hidden rounded">
              <img src="{{asset('images/rooms/2.jpg')}}" class="w-100">
              <h5 class="mt-2">Your Name Here</h5>
          </div>
        <!-- Repeat for each team member -->
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    slidesPerView:3,
    spaceBetween:40,
    loop: true,
    autoplay:{
            delay:3500,
            disableOnInteraction:false,
        },
    pagination: {
      el: ".swiper-pagination",
    },
    breakpoints:{
        320:{
          slidesPerView: 1,
        },
        640:{
          slidesPerView: 1,
        },
        768:{
          slidesPerView: 2,
        },
        1024:{
          slidesPerView: 3,
        },
      }
  });
</script>
@endsection