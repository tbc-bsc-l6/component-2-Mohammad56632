<?php

namespace App\Http\Controllers;

use App\Models\ContactDetail;
use Illuminate\Http\Request;

class ContactDetailsController extends Controller
{
    /**
     * Display the contact details settings page.
     */
    public function index()
    {
        return view('admin.settings');
    }

    /**
     * Update the contact details.
     */
    public function update(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'address' => 'required|string|max:255',
            'gmap' => 'nullable|url|max:255',
            'pn1' => 'nullable|digits_between:10,15',
            'pn2' => 'nullable|digits_between:10,15',
            'email' => 'required|email|max:255',
            'fb' => 'nullable|url|max:255',
            'insta' => 'nullable|url|max:255',
            'tw' => 'nullable|url|max:255',
            'iframe' => 'nullable|string',
        ]);

        // Remove whitespace from input values
        $input = $request->all();
        $input['address'] = trim($request->input('address'));
        $input['gmap'] = trim($request->input('gmap'));
        $input['pn1'] = trim($request->input('pn1'));
        $input['pn2'] = trim($request->input('pn2'));
        $input['email'] = trim($request->input('email'));
        $input['fb'] = trim($request->input('fb'));
        $input['insta'] = trim($request->input('insta'));
        $input['tw'] = trim($request->input('tw'));
        $input['iframe'] = trim($request->input('iframe'));

        // Find the existing contact details or fail
        $contactdetails = ContactDetail::firstOrFail();

        // Update the fields with trimmed and validated input
        $contactdetails->address = $input['address'];
        $contactdetails->gmap = $input['gmap'];
        $contactdetails->pn1 = $input['pn1'];
        $contactdetails->pn2 = $input['pn2'];
        $contactdetails->email = $input['email'];
        $contactdetails->fb = $input['fb'];
        $contactdetails->insta = $input['insta'];
        $contactdetails->tw = $input['tw'];
        $contactdetails->iframe = $input['iframe'];

        // Check for changes and save
        if ($contactdetails->isDirty()) {
            $contactdetails->save();
            return redirect()->back()->with('success', 'Contact details updated successfully!');
        }

        return redirect()->back()->with('error', 'No changes were made to the contact details.');
    }
}
