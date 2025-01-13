<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $logo = GeneralSetting::first();

        return view('about', compact('logo'));
    }
}
