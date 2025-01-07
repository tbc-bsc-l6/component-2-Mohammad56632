
    <!-- Navigation Bar -->
    <nav id="nav-bar" class="navbar navbar-expand-lg bg-light bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">Rain Hotel</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link me-2" href="{{url('/')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link me-2" href="{{route('room.index')}}">Rooms</a></li>
                    <li class="nav-item"><a class="nav-link me-2" href={{route('facilities.index')}}>Facilities</a></li>
                    <li class="nav-item"><a class="nav-link me-2" href="{{route('contact.index')}}">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('about.index')}}">About</a></li>
                </ul>
                @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="btn btn-success shadow-none"
                        >
                            Log in
                        </a>
            
                        @if (Route::has('register'))
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


