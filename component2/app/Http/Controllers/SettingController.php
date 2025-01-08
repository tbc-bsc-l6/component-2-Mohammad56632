<?php

namespace App\Http\Controllers;

use App\Models\ContactDetail;
use App\Models\GeneralSetting;
use App\Models\TeamDetails;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $generalSettings = GeneralSetting::first();
        $contactdetails = ContactDetail::first();
        $team = TeamDetails::orderBy('created_at', 'desc')->get();
        return view('admin.settings', compact('generalSettings','contactdetails','team'));
    }
    public function update(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'sitetitle' => 'required|string|max:15',
            'aboutus' => 'required|string|max:255',
        ]);
    
        // Remove whitespace from input values
        $sitetitle = trim($request->input('sitetitle'));
        $aboutus = trim($request->input('aboutus'));
    
        // Find the general settings record
        $generalSettingsUpdate = GeneralSetting::firstOrFail();
    
        // Update the fields only if the new values are different
        $generalSettingsUpdate->sitetitle = $sitetitle;
        $generalSettingsUpdate->aboutus = $aboutus;
    
        // Save the updated settings
        if ($generalSettingsUpdate->isDirty()) { // Check if changes exist
            $generalSettingsUpdate->save();
    
            // Redirect with success message
            return redirect()->back()->with('success', 'General Settings updated successfully!');
        }
    
        // Redirect back with no changes message
        return redirect()->back()->with('error', 'No changes were made.');
    }
    
}
