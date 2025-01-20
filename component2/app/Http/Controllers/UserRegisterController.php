<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserRegisterController extends Controller
{
    public function index(){
        $registerUser = User::orderby('created_at', 'desc')->paginate(10); // 10 records per page
        return view('admin.registerUser',compact('registerUser'));
    }
    public function updateStatus(Request $request, $id)
{
    $user = User::find($id);

    if ($user) {
        // Toggle the user's status (1 -> 0, 0 -> 1)
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();

        return redirect()->back()->with('success', 'User status updated successfully.');
    }

    return redirect()->back()->with('error', 'User not found.');
}

}
