        <div class="container-fluid bg-white mt-5">
            <div class="row">
                <div class="col-lg-4 p-4">
                    <h3 class="h-font fw-bold fs-3 mb-2">{{$logo->sitetitle}}</h3>
                    <p>
                        {{$logo->aboutus}}
                    </p>
                </div>
                <div class="col-lg-4 p-4">
                    <h5 class="mb-3">Links</h5>
                    <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
                    <a href="{{route('room.index')}}" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
                    <a href="{{route('facilities.index')}}" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
                    <a href="{{route('contact.index')}}" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a><br>
                    <a href="{{route('about.index')}}" class="d-inline-block mb-2 text-dark text-decoration-none">About us</a><br>
        
                </div>
        
                <div class="col-lg-4 p-4">
                    <h5 class="mb-3">Follow us</h5>
                    <a href="#" class="d-inline-block text-decoration-none text-dark mb-2"><i
                            class="bi bi-twitter me-1"></i>Twitter</a><br>
                    <a href="#" class="d-inline-block text-decoration-none text-dark mb-2"><i
                            class="bi bi-facebook me-1"></i>Facebook</a><br>
                    <a href="#" class="d-inline-block text-decoration-none text-dark"><i
                            class="bi bi-instagram me-1"></i>Instagram</a><br>
        
                </div>
            </div>
        </div>
        
        <div>
          <h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed by Mohammad Naushad Rain</h6>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://unpkg.com/swiper@7/swiper-boundle.main.js"></script>
        <script src="{{asset('js/main.js')}}"></script>
      </body>
      </html>