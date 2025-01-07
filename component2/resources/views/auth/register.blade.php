<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        /* Background styling */
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Roboto', sans-serif;
        }

        /* Form container styling */
        form {
            max-width: 900px;
            width: 100%;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Header styling */
        .modal-header {
            background: #2575fc;
            color: white;
            padding: 20px;
            border-bottom: 0;
        }

        .modal-header h1 {
            font-size: 24px;
            font-weight: bold;
        }

        /* Input field styling */
        .form-control {
            border: 2px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            transition: 0.3s ease;
        }

        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
        }

        /* Submit button styling */
        .btn-dark {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: bold;
            color: white;
        }

        .btn-dark:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
            transform: scale(1.05);
        }

        /* Forgot password link */
        .text-secondary {
            transition: 0.3s ease;
        }

        .text-secondary:hover {
            color: #2575fc;
            text-decoration: underline;
        }
    </style>
  </head>

  <body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="mx-3">
            <div class="text-center">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i>User Register</h1>
                    </div>
                
                    <div class="modal-body">
                        <span class="badge rounded-pill bg-light text-dark text-wrap mb-3">
                            Note: Your details must match your ID (National ID, passport, driving license, etc.) during check-in.
                        </span>
                        
                
                        <div class="modal-body p-4">
                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" id="name" type="text" class="form-control shadow-none @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" id="email" type="email" class="form-control shadow-none @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <!-- Phone -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input name="phone" id="phone" type="number" class="form-control shadow-none @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <!-- Profile Picture -->
                                <div class="col-md-6 mb-3">
                                    <label for="profile" class="form-label">Profile Picture</label>
                                    <input name="profile" id="profile" type="file" accept=".jpg,.jpeg,.png,.webp" class="form-control shadow-none @error('profile') is-invalid @enderror">
                                    @error('profile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <!-- Address -->
                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" id="address" class="form-control shadow-none @error('address') is-invalid @enderror" rows="2">{{ old('address') }}</textarea>
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <!-- Gender -->
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-select shadow-none @error('gender') is-invalid @enderror">
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <!-- Date of Birth -->
                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input name="dob" id="dob" type="date" class="form-control shadow-none @error('dob') is-invalid @enderror" value="{{ old('dob') }}">
                                    @error('dob')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="dpassword" class="form-label">Password</label>
                                    <input name="dpassword" id="dpassword" type="password" class="form-control shadow-none @error('dpassword') is-invalid @enderror" value="{{old('dpassword')}}">
                                    @error('dpassword')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                
                                <!-- Confirm Password -->
                                <div class="col-md-6 mb-3">
                                    <label for="cpassword" class="form-label">Confirm Password</label>
                                    <input name="cpassword" id="cpassword" type="password" class="form-control shadow-none @error('cpassword') is-invalid @enderror" value="{{old('cpassword')}}">
                                    @error('cpassword')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                             <!-- Remember Me Checkbox and Login Button -->
          <div class="d-flex align-items-center justify-content-between mb-2">
            <button type="submit" class="btn btn-dark shadow-none">{{ __('Register') }}</button>
            <a href="{{ route('login') }}" class="text-secondary text-decoration-none"> {{ __('I already have an account') }}</a>
        </div>
                        
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS and Popper.js (necessary for Bootstrap 5 components like modals to work) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
