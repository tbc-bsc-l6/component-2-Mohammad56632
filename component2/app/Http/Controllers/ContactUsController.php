<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        $logo = GeneralSetting::first();

        return view('contactus',compact('logo'));
    }
}
