<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class facilitiesController extends Controller
{
    public function index(){
        $logo = GeneralSetting::first();
        $facilities = Facilities::orderby('created_at','desc')->get();
        return view('facilities',compact('logo','facilities'));
    }
}
