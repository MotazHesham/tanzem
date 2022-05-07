<?php

namespace App\Http\Controllers\Api\V1\Cader;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cawader;
use App\Models\Event;
use App\Models\City;
use App\Models\CawaderSpecialization;
use App\Models\BreakType;
use App\Models\Skill;
use App\Models\Setting;
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\V1\Cader\CaderResource;
use App\Http\Resources\V1\Cader\CityResource;
use App\Http\Resources\V1\Cader\SpecializationResource;
use App\Http\Resources\V1\Cader\SkillResource;
use App\Http\Resources\V1\Cader\DegreeResource;
use App\Traits\api_return;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Resources\V1\Cader\BreakTypesResource;

class UsersApiController extends Controller
{
    use api_return;
    use MediaUploadingTrait;

    public function specializations(){
        $specializations = CawaderSpecialization::all();
        return $this->returnData(SpecializationResource::collection($specializations));
    }

    public function skills(){
        $skills = Skill::all();
        return $this->returnData(SkillResource::collection($skills));
    }

    public function cities(){
        $cities = City::all();
        return $this->returnData(CityResource::collection($cities));
    }

    public function degrees(){
        $degrees = Cawader::DEGREE_SELECT;
        $degrees2 = [];
        foreach($degrees as $key => $label){
            $degrees2[$key] = trans('global.degree.' . $label);
        }
        return $this->returnData(new DegreeResource($degrees2));
    }

    public function breaks_type(){
        $breaks = BreakType::get();
        return $this->returnData(BreakTypesResource::collection($breaks),"success");
    }

    public function profile()
    {
        return $this->returnData(new CaderResource(Auth::user()), "success");
    }

    public function update(Request $request){

        $rules = [
            'email' => 'required|unique:users,email,'.Auth::id(),
            'phone' => 'required|size:10|regex:/(05)[0-9]{8}/',
            'name' => 'required|string',
            'has_skills' => [
                'required',
                'in:1,0',
            ],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();

        $cawader = Cawader::where('user_id',Auth::id())->first();
        $cawader->has_skills = $request->has_skills;
        $cawader->save();

        if (request()->hasFile('photo') && request('photo') != '' && request('photo') != $user->photo){
            $validator = Validator::make($request->all(), [
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            }
            $user->addMedia(request('photo'))->toMediaCollection('photo');
        }

        if(!$user){
            return $this->returnError('404',trans('global.flash.api.not_found'));
        }

        $user->update($request->all());
        $user = User::find($user->id); // to solve problem photo is not return after update

        return $this->returnData(new CaderResource($user),trans('global.flash.api.profile_updated'));
    }

    public function update_password(Request $request){
        $rules = [
            'old_password' => 'required|min:6|max:20',
            'password' => 'required|min:6|max:20|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();
        $hashedPassword = $user->password;
        if(!\Hash::check($request->old_password, $hashedPassword)){
            return $this->returnError('401',trans('global.flash.api.old_password_not_correct'));
        }else{
            $user->password = bcrypt($request->password);
            $user->save();
            return $this->returnSuccessMessage(trans('global.flash.api.password_updated'));
        }
    }

    public function update_fcm_token(Request $request){

        $rules = [
            'fcm_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();

        if(!$user)
            return $this->returnError('404',trans('global.flash.api.not_found'));

        $user->update($request->all());


        return $this->returnSuccessMessage('Token Updated Successfully');
    }

    public function terms(Request $request){
       
       
        if($request->type==1){
               $cawder = 'terms_cawader_' . app()->getLocale(); 
               $terms=Setting::first()->$cawder;
        }
        elseif($request->type==2){
               $company = 'terms_company_' . app()->getLocale(); 
               $terms=Setting::first()->$company;
        }
        else{
            $visitor = 'terms_visitor_' . app()->getLocale(); 
            $terms=Setting::first()->$visitor;
           

        }
         return   $this->returnData($terms);
            
        }
    }
