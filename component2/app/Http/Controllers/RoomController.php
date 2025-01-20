<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use App\Models\GeneralSetting;
use App\Models\Review;
use App\Models\RoomImage;
use App\Models\Rooms;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $logo = GeneralSetting::first();
        $rooms = Rooms::with('features.feature', 'facilities.facility')->orderby('created_at', 'desc')->get();
        $roomImage = RoomImage::all();
        $facilities = Facilities::orderby('created_at', 'desc')->get();
        return view('rooms', compact('logo', 'rooms', 'roomImage', 'facilities'));
    }
    public function showroom($id)
    {
        $logo = GeneralSetting::first();
        $review = Review::with(['room', 'user'])->orderby('created_at', 'desc')->take(4)->get();

        // Fetch only the images related to the specific room
        // Fetch only the images related to the specific room with status 0 or 1
        $roomImages = RoomImage::where('room_id', $id)
            ->whereIn('status', [0, 1])
            ->get();
        // Fetch the room details along with related features, facilities, and images
        $roomdetails = Rooms::with('features.feature', 'facilities.facility')
            ->findOrFail($id);

        return view('roomsdeatils', compact('roomdetails', 'logo', 'roomImages', 'review'));
    }

    public function filterRooms(Request $request)
    {
        $rooms = Rooms::with('features.feature', 'facilities.facility')
            ->when($request->check_in, function ($query, $check_in) {
                $query->where('available_from', '<=', $check_in);
            })
            ->when($request->check_out, function ($query, $check_out) {
                $query->where('available_to', '>=', $check_out);
            })
            ->when($request->facilities, function ($query, $facilities) {
                $query->whereHas('facilities', function ($q) use ($facilities) {
                    $q->whereIn('facility_id', $facilities);
                });
            })
            ->when($request->adults, function ($query, $adults) {
                $query->where('adult', '>=', $adults);
            })
            ->when($request->children, function ($query, $children) {
                $query->where('children', '>=', $children);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $roomImage = RoomImage::all();

        return response()->json([
            'rooms' => view('partials.rooms_list', compact('rooms', 'roomImage'))->render()
        ]);
    }
}
