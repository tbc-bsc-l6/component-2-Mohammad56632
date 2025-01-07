<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'numeric', 'digits_between:10,15'],
            'profile' => ['required', 'file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'address' => ['required', 'string', 'max:1000'],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'dob' => ['required', 'date', 'before:today'],
            'dpassword' => [
                'required',
                'string',
                'min:6',
                'regex:/[A-Z]/',   // At least one uppercase letter
                'regex:/[a-z]/',   // At least one lowercase letter
                'regex:/[0-9]/',   // At least one digit
                'regex:/[@#!$%*]/', // At least one special character
            ],
            'cpassword' => 'required|same:dpassword',
        ]);

        // Check if file exists and store the file
        $fileName = null;
        if ($request->hasFile('profile')) {
            $fileName = time() . '_' . uniqid() . '.' . $request->file('profile')->getClientOriginalExtension();
            $profilePath = $request->file('profile')->storeAs('profiles', $fileName, 'public');
            $FileURL = Storage::url($profilePath);
        }

        // Create the new user with the validated data
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'profile' => $FileURL, // Store the file path
            'address' => $request->address,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'password' => Hash::make($request->dpassword),
        ]);

        // Automatically login the user
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'User registered successfully.');
    }
}
