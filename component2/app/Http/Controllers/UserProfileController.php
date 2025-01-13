<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index(){
        $logo = GeneralSetting::first();
        return view('userprofile',compact('logo'));
    }
}
