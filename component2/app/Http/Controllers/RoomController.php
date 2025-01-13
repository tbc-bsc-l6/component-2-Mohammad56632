<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
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

        return view('rooms', compact('logo', 'rooms', 'roomImage'));
    }
    public function showroom($id)
    {
        $logo = GeneralSetting::first();
        // Fetch only the images related to the specific room
        // Fetch only the images related to the specific room with status 0 or 1
        $roomImages = RoomImage::where('room_id', $id)
            ->whereIn('status', [0, 1])
            ->get();
        // Fetch the room details along with related features, facilities, and images
        $roomdetails = Rooms::with('features.feature', 'facilities.facility')
            ->findOrFail($id);

        return view('roomsdeatils', compact('roomdetails', 'logo', 'roomImages'));
    }
}
