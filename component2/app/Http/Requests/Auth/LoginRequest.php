<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email_or_phone' => ['required', 'string'], // Accept email or phone
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $credentials = $this->credentials();

        // Attempt to authenticate using the provided credentials
        if (! Auth::attempt($credentials, $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email_or_phone' => trans('auth.failed'),
            ]);
        }

        // Check user's role and redirect based on the role
        $user = Auth::user();

        if ($user->role == 2) {
            session()->put('dashboard_redirect', route('dashboard'));
        } elseif ($user->role == 1) {
            session()->put('dashboard_redirect', route('user.dashboard'));
        } else {
            Auth::logout();
            throw ValidationException::withMessages([
                'email_or_phone' => 'Unauthorized access.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Get the credentials for authentication.
     */
    public function credentials(): array
    {
        $input = $this->input('email_or_phone');

        // Check if the input is an email or phone and return credentials accordingly
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $input, 'password' => $this->input('password')];
        }

        return ['phone' => $input, 'password' => $this->input('password')];
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email_or_phone' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email_or_phone')).'|'.$this->ip());
    }
}
