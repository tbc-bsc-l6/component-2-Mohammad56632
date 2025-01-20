<?php

namespace App\Http\Controllers;

use App\Models\BookingDetail;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class ShowBookingListController extends Controller
{
    public function index(){
        $logo = GeneralSetting::first();
        $bookingDetails = BookingDetail::with(['user', 'room'])->orderby('created_at','desc')->get();
        return view('viewBooking',compact('logo','bookingDetails'));
    }
    public function destroy($id)
{
    // Find the booking by ID
    $booking = BookingDetail::find($id);

    if ($booking) {
        // Delete the booking
        $booking->delete();

        // Redirect with a success message
        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }

    // Redirect with an error message if the booking doesn't exist
    return redirect()->back()->with('error', 'Booking not found.');
}

}
