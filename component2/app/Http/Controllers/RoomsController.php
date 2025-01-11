<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use App\Models\Features;
use App\Models\RoomFacilities;
use App\Models\RoomFeatures;
use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function index()
    {
        $feature = Features::all();
        $facilitie = Facilities::all();
        // Fetch rooms with their associated room_facilities and room_features
        $rooms = Rooms::with('features.feature', 'facilities.facility')->get();
        // $r_facilities = RoomFacilities::with('facility')->get();
        // $r_features = RoomFeatures::with('feature')->get();
        return view('admin.rooms', compact('feature', 'facilitie', 'rooms'));
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
}
