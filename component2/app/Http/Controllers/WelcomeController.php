<?php

namespace App\Http\Controllers;

use App\Models\Carouse;
use App\Models\GeneralSetting;
use App\Models\RoomImage;
use App\Models\Rooms;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){

        $logo = GeneralSetting::first();
        $slider = Carouse::all();
        $rooms = Rooms::with('features.feature', 'facilities.facility')->orderby('created_at', 'desc')->take(3)->get();
        $roomImage = RoomImage::all();
        return view('welcome',compact('logo','slider','rooms','roomImage'));
    }
}
