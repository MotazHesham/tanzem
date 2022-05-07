<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cawader;
use App\Models\Setting;

class CadersController extends Controller
{
    public function caders(Request $request){

        $setting = Setting::first();
        $specialization_id = null;
        $skill_id = null;
       
        $cawaders = Cawader::where('companies_and_institution_id',null);
        if($request->has('specialization_id') && $request->specialization_id != null){
            global $specialization_id;
            $specialization_id = $request->specialization_id;
            $cawaders = $cawaders->whereHas('specializations',function ($query) {
                $query->where('id', 'like', $GLOBALS['specialization_id']);
            });
        }
        if($request->has('skill_id') && $request->skill_id != null){
            global $skill_id;
            $skill_id = $request->skill_id;
            $cawaders = $cawaders->whereHas('skills',function ($query) {
                $query->where('id', 'like', $GLOBALS['skill_id']);
            });
        }

        $cawaders =  $cawaders->orderBy('created_at','desc')->paginate(12);
        $cawaders->appends($request->all());
        return view('frontend.caders',compact('cawaders','setting','specialization_id','skill_id'));
    }

    public function cader($id){
        $cader = Cawader::findOrFail($id);
        return view('frontend.cader',compact('cader'));
    }
}
