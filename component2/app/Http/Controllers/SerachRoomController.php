<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use App\Models\GeneralSetting;
use App\Models\Review;
use App\Models\RoomImage;
use App\Models\Rooms;
use Illuminate\Http\Request;

class SerachRoomController extends Controller
{
    public function search(Request $request)
    {
        $facilities = Facilities::orderby('created_at', 'desc')->get();
        $roomImage = RoomImage::all();

        $logo = GeneralSetting::first();
        $review = Review::with(['room', 'user'])->orderby('created_at', 'desc')->take(4)->get();

        // Validate input
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ], [
            'check_in.after_or_equal' => 'The check-in date must be today or a future date.',
            'check_out.after' => 'The check-out date must be after the check-in date.',
        ]);

        // Get search parameters
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        $adults = $request->input('adults');
        $children = $request->input('children');

        // Query the database
        $rooms = Rooms::query()
            ->when($adults, function ($query, $adults) {
                return $query->where('adult', '>=', $adults);
            })
            ->when($children, function ($query, $children) {
                return $query->where('children', '>=', $children);
            })
            ->orderByRaw('(ABS(adult - ?) + ABS(children - ?))', [$adults, $children])
            ->get();

        // Return view with filtered rooms
        return view('serachRoom', compact('rooms','facilities','logo','roomImage','review'));
    }
}
