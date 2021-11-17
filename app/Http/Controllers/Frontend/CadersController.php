<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cawader;
use App\Models\Setting;

class CadersController extends Controller
{
    public function caders(){
        $setting = Setting::first();
        $cawaders = Cawader::orderBy('created_at','desc')->paginate(12);
        return view('frontend.caders',compact('cawaders','setting'));
    }

    public function cader($id){
        $cader = Cawader::findOrFail($id);
        return view('frontend.cader',compact('cader'));
    }
}
