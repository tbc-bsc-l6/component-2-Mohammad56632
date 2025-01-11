<?php

namespace App\Http\Controllers;

use App\Models\Carouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousel = Carouse::orderBy('created_at','desc')->get();

        return view('admin.carousel',compact('carousel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB max file size
        ]);

        try {
            // Handle the image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate a unique image name
                $imagePath = $image->storeAs('carousel', $imageName, 'public'); // Store image in 'team' folder in storage/app/public

                // Get the image URL for the stored image
                $imageURL = Storage::url($imagePath);
            } else {
                // If no image was uploaded, you can choose to show an error or handle accordingly
                return redirect()->back()->with('error', 'Please upload a valid image!');
            }

            // Store the data in the database
            $carousel = Carouse::create([
                'image' => $imageURL, // Store the image URL in the database
            ]);

            // Check if the team member was successfully created and return the appropriate message
            if ($carousel) {
                return redirect()->back()->with('success', 'Carousel added successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to add Carousel !');
            }
        } catch (\Exception $e) {
            // Handle any errors during the process
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Carouse $carouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carouse $carouse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carouse $carouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function toggleStatus($id)
    {
        $carousel = Carouse::findOrFail($id);

        // Toggle the status (1 -> 0 or 0 -> 1)
        $carousel->status = !$carousel->status;
        $carousel->save();

        return redirect()->back()->with('success', 'carousels status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $carousel = Carouse::findOrFail($id);

        // Delete the team member image if exists
        if ($carousel->image && file_exists(public_path('storage/' . $carousel->image))) {
            unlink(public_path('storage/' . $carousel->image));
        }

        // Delete the team member
        $carousel->delete();

        return redirect()->back()->with('success', 'carousels deleted successfully!');
    }
}
