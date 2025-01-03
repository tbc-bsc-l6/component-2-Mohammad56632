
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
                <div class="d-flex">
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    @csrf

                
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h1 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i>User Login</h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                
                    <!-- Modal Body -->
                    <div class="modal-body">
                
                        <!-- Error Message Alert -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> Invalid credentials, please try again.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <!-- Email Input -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" class="form-control shadow-none" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        </div>
                
                        <!-- Password Input -->
                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" class="form-control shadow-none" type="password" name="password" required autocomplete="current-password" />
                        </div>
                
                        <!-- Remember Me Checkbox -->
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">{{ __('Log in') }}</button>
                                <a href="{{ route('password.request') }}" class="text-secondary text-decoration-none"> {{ __('Forgot your password?') }}</a>
                        </div>
                    </div>
                </form>
                
                
              
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" id="register-form">
                    <div class="modal-header">
                        <h1 class="modal-title d-flex align-items-center"><i class="bi bi-person-lines-fill fs-3 me-2"></i>User Register</h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill bg-light text-dark text-wrap mb-3">Note: Your details must match your ID (National ID, passport, driving license, etc.) required during check-in.</span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input name="phonenum" type="number" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Picture</label>
                                    <input name="profile" type="file" accept=".jpg,.jpeg,.png,.webp" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pincode</label>
                                    <input name="pincode" type="number" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input name="dob" type="date" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input name="pass" type="password" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input name="cpass" type="password" class="form-control shadow-none" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center my-1">
                            <button name="register" type="submit" class="btn btn-dark shadow-none">Register</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
