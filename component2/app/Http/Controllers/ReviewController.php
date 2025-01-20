<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index()
    {
        $review = Review::with(['room', 'user'])->orderby('created_at', 'desc')->paginate(8);
        return view('admin.review', compact('review'));
    }
    public function store(Request $request, $roomId)
    {
        // Validate the request data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'required|string|max:1000',
        ]);

        // Store the review in the database
        Review::create([
            'user_id' => Auth::id(), // Get the currently authenticated user's ID
            'room_id' => $roomId,   // Store the room ID
            'review' => $request->rating, // Store the rating as review
            'description' => $request->description, // Store the description
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Thank you for your review!');
    }

    public function toggleStatus($id)
    {
        $review = Review::findOrFail($id);

        // Toggle the status (0 to 1 or 1 to 0)
        $review->status = !$review->status;
        $review->save();

        return redirect()->back()->with('success', 'Review status updated successfully.');
    }
}
