<?php

namespace App\Http\Controllers;

use App\Models\TeamDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.settings');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB max file size
        ]);

        try {
            // Handle the image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate a unique image name
                $imagePath = $image->storeAs('team', $imageName, 'public'); // Store image in 'team' folder in storage/app/public

                // Get the image URL for the stored image
                $imageURL = Storage::url($imagePath);
            } else {
                // If no image was uploaded, you can choose to show an error or handle accordingly
                return redirect()->back()->with('error', 'Please upload a valid image!');
            }

            // Store the data in the database
            $teamMember = TeamDetails::create([
                'name' => $request->name,
                'image' => $imageURL, // Store the image URL in the database
            ]);

            // Check if the team member was successfully created and return the appropriate message
            if ($teamMember) {
                return redirect()->back()->with('success', 'Team member added successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to add team member!');
            }
        } catch (\Exception $e) {
            // Handle any errors during the process
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamDetails $teamDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamDetails $teamDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $teamMember = TeamDetails::findOrFail($id);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Remove old image if it exists
            if ($teamMember->image && file_exists(public_path('storage/' . $teamMember->image))) {
                unlink(public_path('storage/' . $teamMember->image));
            }

            // Upload the new image
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('team', $imageName, 'public');
            $teamMember->image = Storage::url($imagePath);
        }

        // Update the team member data
        $teamMember->name = $request->name;
        $teamMember->save();

        return redirect()->back()->with('success', 'Team member updated successfully!');
    }


    public function toggleStatus($id)
    {
        $teamMember = TeamDetails::findOrFail($id);

        // Toggle the status (1 -> 0 or 0 -> 1)
        $teamMember->status = !$teamMember->status;
        $teamMember->save();

        return redirect()->back()->with('success', 'Team member status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeamDetails $teamDetails, $id)
    {
        $teamMember = TeamDetails::findOrFail($id);

        // Delete the team member image if exists
        if ($teamMember->image && file_exists(public_path('storage/' . $teamMember->image))) {
            unlink(public_path('storage/' . $teamMember->image));
        }

        // Delete the team member
        $teamMember->delete();

        return redirect()->back()->with('success', 'Team member deleted successfully!');
    }
}
