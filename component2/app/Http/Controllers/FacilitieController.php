<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilitieController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'facility_name' => 'required|string|max:100',
            'facility_desc' => 'required|string|max:255',
            'facility_icon' => 'required|image|mimes:svg,jpg,jpeg,png,webp|max:2048', // 2MB max file size
        ]);

        try {
            // Handle the image upload
            if ($request->hasFile('facility_icon')) {
                $image = $request->file('facility_icon');
                $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate a unique image name
                $imagePath = $image->storeAs('facilities', $imageName, 'public'); // Store image in 'team' folder in storage/app/public

                // Get the image URL for the stored image
                $imageURL = Storage::url($imagePath);
            } else {
                // If no image was uploaded, you can choose to show an error or handle accordingly
                return redirect()->back()->with('error', 'Please upload a valid image!');
            }

            // Store the data in the database
            $facilities = Facilities::create([
                'name' => $request->facility_name,
                'description' => $request->facility_desc,
                'icon_path' => $imageURL, // Store the image URL in the database
            ]);

            // Check if the team member was successfully created and return the appropriate message
            if ($facilities) {
                return redirect()->back()->with('success', 'facilities  added successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to add team member!');
            }
        } catch (\Exception $e) {
            // Handle any errors during the process
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified facilities in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the input fields
        $request->validate([
            'facility_name' => 'required|string|max:100',
            'facility_desc' => 'required|string|max:255',
            'facility_icon' => 'nullable|image|mimes:svg,jpg,jpeg,png,webp|max:2048', // Image is optional
        ]);

        $facilities = Facilities::findOrFail($id);

        try {
            // Handle the image upload
            if ($request->hasFile('facility_icon')) {
                // Remove old image if it exists
                if (!empty($facilities->icon_path) && file_exists(public_path($facilities->icon_path))) {
                    unlink(public_path($facilities->icon_path));
                }

                // Upload the new image
                $image = $request->file('facility_icon');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('facilities', $imageName, 'public');
                $facilities->icon_path = 'storage/' . $imagePath; // Correctly set the path
            }

            // Update the facility data
            $facilities->name = $request->facility_name;
            $facilities->description = $request->facility_desc;

            // Save the updated facility data
            if ($facilities->isDirty()) { // Check if changes exist
                $facilities->save();

                // Redirect with success message
                return redirect()->back()->with('success', 'Facilities updated successfully!');
            }

            // Redirect back with no changes message
            return redirect()->back()->with('error', 'No changes were made.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }


    public function destory($id)
    { {
            $facilities = Facilities::findOrFail($id);

            // Delete the team member image if exists
            if ($facilities->image && file_exists(public_path('storage/' . $facilities->image))) {
                unlink(public_path('storage/' . $facilities->icon_path));
            }

            // Delete the team member
            $facilities->delete();

            return redirect()->back()->with('success', 'Facilities deleted successfully!');
        }
    }
}
