<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use App\Models\Features;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeaturesController extends Controller
{
    public function index(){
        $feature = Features::orderby('created_at','desc')->get();
        $facilitie = Facilities::orderby('created_at','desc')->get();
        return view('admin.features_facilities',compact('feature','facilitie'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);
    
        // Remove unwanted whitespace and HTML/script tags
        $cleanedName = strip_tags(trim($request->name));
    
        $featuresStore = Features::create([
            'name' => $cleanedName,
        ]);
    
        if ($featuresStore) {
            return redirect()->back()->with('success', 'Feature added successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to add feature!');
        }
    }
    
    public function destory($id){
        $featuredelte = Features::findOrFail($id) ;
        $featuredelte->delete();
        return redirect()->back()->with('success','features delete success !!!');
  
    }

}
