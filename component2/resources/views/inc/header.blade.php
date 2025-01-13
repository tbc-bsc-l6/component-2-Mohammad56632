
    <!-- Navigation Bar -->
    <nav id="nav-bar" class="navbar navbar-expand-lg bg-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">{{$logo->sitetitle}}</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link me-2" href="{{route('welcome')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link me-2" href="{{route('room.index')}}">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link me-2" href={{route('facilities.index')}}>Facilities</a></li>
                    <li class="nav-item"><a class="nav-link me-2" href="{{route('contact.index')}}">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('about.index')}}">About</a></li>
                </ul>
                @if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end items-center">
        @auth

        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{Auth::user()->name}}
            </a>
          
            <ul class="dropdown-menu me-4">
                <li><img src="{{ asset(Auth::user()->profile) }}" alt="Profile" class="rounded-circle" width="30" height="30">
                </li>
              <li><a class="dropdown-item" href="#">Your Booking</a></li>
              <li><a class="dropdown-item" href="{{route('user.profile')}}">Profile</a></li>
              <li>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="dropdown-item " href="#">Logout</button>
                </form>
                </li>
            </ul>
          </div>
        @else
            <!-- Login Button -->
            <a 
                href="{{ route('login') }}" 
                class="btn btn-success shadow-none"
            >
                Log in
            </a>

            @if (Route::has('register'))
                <!-- Register Button -->
                <a 
                    href="{{ route('register') }}" 
                    class="btn btn-info shadow-none"
                >
                    Register
                </a>
            @endif
        @endauth
    </nav>
@endif

            
            </div>
        </div>
    </nav>


