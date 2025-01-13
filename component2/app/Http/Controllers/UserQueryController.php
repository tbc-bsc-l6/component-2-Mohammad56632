<?php

namespace App\Http\Controllers;

use App\Models\UserQuery;
use Illuminate\Http\Request;

class UserQueryController extends Controller
{
    public function index()
    {
        $userQuery = UserQuery::orderBy('created_at', 'desc')->paginate(6); // 5 items per page
        return view('admin.user_queries',compact('userQuery'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:255',
        ]);
    
        // Sanitize inputs by trimming whitespace and removing HTML/JS tags
        $sanitizedData = [
            'name' => strip_tags(trim($request->input('name'))),
            'email' => strip_tags(trim($request->input('email'))),
            'subject' => strip_tags(trim($request->input('subject'))),
            'message' => strip_tags(trim($request->input('message'))),
        ];
    
        // Store the sanitized data in the database
        UserQuery::create($sanitizedData);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function destory($id){
        $userQueryDelete = UserQuery::findOrFail($id);
        $userQueryDelete->delete();
        return redirect()->back()->with('success', 'Your message has been sent successfully!');

    }
    
}
