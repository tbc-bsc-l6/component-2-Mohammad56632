<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
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
          max-width: 400px;
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
    <!-- Session Status -->
    @if (session('status'))
    <div class="alert alert-success mb-4">
        {{ session('status') }}
    </div>
    @endif

    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form method="POST" action="{{ route('login') }}" style="width: 100%; max-width: 400px;">
            @csrf
            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i>User Login</h1>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
                <!-- Email or Phone Input -->
                <div class="mb-3">
                    <label for="email_or_phone" class="form-label">{{ __('Email or Phone') }}</label>
                    <input id="email_or_phone" class="form-control shadow-none @error('email_or_phone') is-invalid @enderror" type="text" name="email_or_phone" value="{{ old('email_or_phone') }}" autofocus autocomplete="username" />
                    @error('email_or_phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" class="form-control shadow-none @error('password') is-invalid @enderror" type="password" name="password" autocomplete="current-password" />
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me Checkbox and Login Button -->
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <button type="submit" class="btn btn-dark shadow-none">{{ __('Log in') }}</button>
                    <a href="{{ route('password.request') }}" class="text-secondary text-decoration-none"> {{ __('Forgot your password?') }}</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
