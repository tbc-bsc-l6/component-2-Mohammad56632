<?php

namespace App\Http\Controllers;

use App\Models\ContactDetail;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        $logo = GeneralSetting::first();
        $cd = ContactDetail::first();
        return view('contactus',compact('logo','cd'));
    }
}
