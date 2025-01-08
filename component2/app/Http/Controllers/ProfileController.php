<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.adminprofile', [
            'user' => $request->user(),
        ]);
    }

      /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Validate the form data (including file upload)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'gender' => 'nullable|string|in:male,female,other',
            'dob' => 'nullable|date',
            'role' => 'nullable|in:1,2', // Only allow 1 or 2 for role (1 = User, 2 = Admin)
        ]);

        // Check if an image is uploaded and valid
        if ($request->hasFile('profile')) {
            $request->validate([
                'profile' => 'image|mimes:jpg,jpeg,png,gif|max:2048', // validate image after the upload
            ]);

            // Store the image and get the path
            $imagePath = $request->file('profile')->store('profile_images', 'public');

            // Add the image path to the validated data
            $validated['profile'] = $imagePath;
        }

        // Fill the user's data with validated data
        $user = $request->user();
        $user->fill($validated);

        // If the email has changed, reset the verification status
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save the user's updated data
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
