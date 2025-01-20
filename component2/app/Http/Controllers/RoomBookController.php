<?php

namespace App\Http\Controllers;

use App\Models\BookingDetail;
use App\Models\GeneralSetting;
use App\Models\RoomImage;
use App\Models\Rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoomBookController extends Controller
{
    public function index($id)
    {
        $logo = GeneralSetting::first();
        $roomImages = RoomImage::where('room_id', $id)
            ->whereIn('status', [0, 1])
            ->get();
        // Fetch the room details along with related features, facilities, and images
        $roomdetails = Rooms::with('features.feature', 'facilities.facility')
            ->findOrFail($id);
        return view('roomsBook', compact('logo', 'roomImages', 'roomdetails'));
    }
    public function store(Request $request, $room_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to book a room.');
        }

        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'user_phone' => 'required|string|max:15',
            'user_address' => 'required|string|max:255',
            'check_in' => [
                'required',
                'date',
                'after:today',
                function ($attribute, $value, $fail) {
                    $tomorrow = now()->addDay();
                    $maxDate = now()->addDays(10);

                    if (!($value >= $tomorrow->toDateString() && $value <= $maxDate->toDateString())) {
                        $fail("The {$attribute} must be between tomorrow and 10 days from today.");
                    }
                },
            ],
            'check_out' => [
                'nullable',
                'date',
                'after:check_in',
                function ($attribute, $value, $fail) {
                    $minCheckout = now()->addDays(2);

                    if ($value < $minCheckout->toDateString()) {
                        $fail("The {$attribute} must be at least 2 days after check-in.");
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        BookingDetail::create([
            'user_id' => Auth::id(),
            'room_id' => $room_id,
            'user_name' => $request->user_name,
            'user_phone' => $request->user_phone,
            'user_address' => $request->user_address,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);

        return redirect()->back()->with('success', 'Room successfully booked!');
    }
}
