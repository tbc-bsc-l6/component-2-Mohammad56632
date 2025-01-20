<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\TeamDetails;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $logo = GeneralSetting::first();
        $team = TeamDetails::all();
        return view('about', compact('logo','team'));
    }
}
