<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();

        // Regenerate session to prevent session fixation attacks
        $request->session()->regenerate();

        // Get the authenticated user
        $user = Auth::user();

        // Role-based redirection
        if ($user->role == 1) {
            // Role 1: Redirect to welcome page
            return redirect()->route('welcome')->with('success', 'Login successful!');
        } elseif ($user->role == 2) {
            // Role 2: Redirect to dashboard page
            return redirect()->route('dashboard')->with('success', 'Welcome back, Admin!');
        }

        // Default case: Logout the user if role is invalid
        Auth::logout();
        return redirect()->route('login')->withErrors([
            'email_or_phone' => 'Unauthorized access.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log the user out
        Auth::guard('web')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to home page
        return redirect('/');
    }
}
