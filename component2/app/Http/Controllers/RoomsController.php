<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use App\Models\Features;
use App\Models\RoomFacilities;
use App\Models\RoomFeatures;
use App\Models\RoomImage;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomsController extends Controller
{
    public function index()
    {
        $feature = Features::all();
        $facilitie = Facilities::all();
        // Fetch rooms with their associated room_facilities and room_features
        $rooms = Rooms::with('features.feature', 'facilities.facility')->orderby('created_at', 'desc')->get();
        // $r_facilities = RoomFacilities::with('facility')->get();
        // $r_features = RoomFeatures::with('feature')->get();
        $roomImage = RoomImage::all();
        return view('admin.rooms', compact('feature', 'facilitie', 'rooms', 'roomImage'));
    }
    public function store(Request $request)
    {
        // Form validation
        $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
            'adult' => 'required|numeric|min:1',
            'children' => 'required|numeric|min:1',
            'features' => 'nullable|array',
            'features.*' => 'exists:features,id',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
            'desc' => 'required|string',
        ]);

        // Create the room record
        $room = Rooms::create([
            'name' => $request->name,
            'area' => $request->area,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'adult' => $request->adult,
            'children' => $request->children,
            'description' => $request->desc,
        ]);

        // Attach the selected features to the room
        if ($request->has('features')) {
            foreach ($request->features as $feature_id) {
                RoomFeatures::create([
                    'room_id' => $room->id,
                    'feature_id' => $feature_id
                ]);
            }
        }

        // Attach the selected facilities to the room
        if ($request->has('facilities')) {
            foreach ($request->facilities as $facility_id) {
                RoomFacilities::create([
                    'room_id' => $room->id,
                    'facility_id' => $facility_id
                ]);
            }
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Room added successfully.');
    }

    public function imgStore(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // Validate image type and size
        ]);

        // Find the room by ID
        $room = Rooms::findOrFail($id);

        // Handle the uploaded image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate a unique image name
            $imagePath = $image->storeAs('rooms', $imageName, 'public'); // Store image in 'team' folder in storage/app/public
            $imageURL = Storage::url($imagePath);

            // Create a new RoomImage record and associate it with the room
            $roomImage = new RoomImage();
            $roomImage->room_id = $room->id; // Associate the image with the room
            $roomImage->image = $imageURL;  // Store the path of the uploaded image
            $roomImage->save();              // Save the image record
        }

        // Return a response, you can adjust this as needed
        return redirect()->back()->with('success', 'Image added successfully');
    }


    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
            'adult' => 'required|numeric|min:1',
            'children' => 'required|numeric|min:1',
            'desc' => 'required|string',
            'features' => 'nullable|array',
            'features.*' => 'exists:features,id',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
        ]);

        // Find the room by ID
        $room = Rooms::findOrFail($id);

        // Update room details
        $room->update([
            'name' => $request->input('name'),
            'area' => $request->input('area'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'adult' => $request->input('adult'),
            'children' => $request->input('children'),
            'description' => $request->input('desc'),
        ]);

        // Update features (many-to-many relationship)
        if ($request->has('features')) {
            $room->features()->delete(); // Delete existing features for this room
            foreach ($request->features as $feature_id) {
                RoomFeatures::create([
                    'room_id' => $room->id,
                    'feature_id' => $feature_id
                ]);
            }
        }

        // Update facilities (many-to-many relationship)
        if ($request->has('facilities')) {
            $room->facilities()->delete(); // Delete existing facilities for this room
            foreach ($request->facilities as $facility_id) {
                RoomFacilities::create([
                    'room_id' => $room->id,
                    'facility_id' => $facility_id
                ]);
            }
        }

        // Redirect back with success message
        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }
    public function toggleStatus($id)
    {
        // Find the image by ID
        $roomImage = RoomImage::findOrFail($id);

        // Toggle the status (1 -> 0 or 0 -> 1)
        $roomImage->status = $roomImage->status == 1 ? 0 : 1;

        // Save the updated status
        $roomImage->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Image status updated successfully.');
    }
    public function roomtoggleStatus($id)
    {
        // Find the image by ID
        $roomtoggle = Rooms::findOrFail($id);

        // Toggle the status (1 -> 0 or 0 -> 1)
        $roomtoggle->status = $roomtoggle->status == 1 ? 0 : 1;

        // Save the updated status
        $roomtoggle->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Image status updated successfully.');
    }

    public function destroy(Rooms $room)
    {
        // Delete only the related room_features for the specific room
        RoomFeatures::where('room_id', $room->id)->delete();

        // Delete only the related room_facilities for the specific room
        RoomFacilities::where('room_id', $room->id)->delete();

        // Delete the room itself
        $room->delete();

        return redirect()->back()->with('success', 'Room and its related data deleted successfully.');
    }

    public function imgDelete($id)
    {
        // Find the image by ID
        $roomImage = RoomImage::findOrFail($id);

        // Delete the image file from storage
        if ($roomImage->image && Storage::exists($roomImage->image)) {
            Storage::delete($roomImage->image);
        }

        // Delete the database record
        $roomImage->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
