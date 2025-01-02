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
          <iframe class="w-100 rounded mb-4" height="320" src="your_iframe_source_here" loading="lazy"></iframe>
          <h5>Address</h5>
          <a href="your_gmap_link_here" target="_blank" class="d-inline-block text-decoration-none mb-2 text-dark">
            <i class="bi bi-geo-alt-fill me-1"></i>
            your_address_here
          </a>
          <h5 class="mt-4">Call us</h5>
          <a href="tel: +your_phone_number_1" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill">+your_phone_number_1</i>
          </a>
          <br>
          <a href="tel: +your_phone_number_2" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-fill">+your_phone_number_2</i>
          </a>
          <h5 class="mt-4">Email</h5>
          <a href="mailto:your_email_here" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-envelope-arrow-up-fill me-1"></i>your_email_here
          </a>
        </div>
      </div>
  
      <div class="col-lg-6 col-md-6 mb-5 px-4">
        <div class="bg-white rounded shadow p-4">
          <form action="" method="post">
            <h5>Send a message</h5>
            <div class="mb-3">
              <label class="form-label" style="font-weight: 500;">Name</label>
              <input type="text" name="name" required class="form-control shadow-none">
            </div>
            <div class="mb-3">
              <label class="form-label" style="font-weight: 500;">Email</label>
              <input type="email" name="email" required class="form-control shadow-none">
            </div>
            <div class="mb-3">
              <label class="form-label" style="font-weight: 500;">Subject</label>
              <input type="text" name="subject" required class="form-control shadow-none">
            </div>
            <div class="mb-3">
              <label class="form-label" style="font-weight: 500;">Message</label>
              <textarea name="message" required class="form-control shadow-none" rows="5" style="resize:none;"></textarea>
            </div>
            <button type="submit" name="send" class="btn text-white custom-bg mt-3">SEND</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
@endsection