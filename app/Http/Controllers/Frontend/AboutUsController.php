<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AboutUsController extends Controller
{
    public function about(){
        $setting = Setting::first();
        return view('frontend.aboutus',compact('setting'));
    }
}
