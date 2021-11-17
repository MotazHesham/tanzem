<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting; 
use App\Models\CompaniesAndInstitution;

class OrganizationsController extends Controller
{
    public function organizations(){
        $setting = Setting::first();
        $companiesAndInstitution = CompaniesAndInstitution::paginate(12);
        return view('frontend.organizations',compact('setting','companiesAndInstitution'));
    }

    public function organization($id){ 
        $company = CompaniesAndInstitution::findOrFail($id);
        return view('frontend.organization',compact('company'));
    }
}
