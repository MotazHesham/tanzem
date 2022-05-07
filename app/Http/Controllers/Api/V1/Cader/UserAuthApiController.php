<?php

namespace App\Http\Controllers\Api\V1\Cader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\User;
use App\Models\Cawader;
use Validator;
use Auth;
use App\Http\Controllers\Traits\MediaUploadingTrait;


class UserAuthApiController extends Controller
{
    use api_return;
    use MediaUploadingTrait;

    public function register(Request $request){

        $rules = [
            'dob' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'degree' => [
                'required',
            ],
            'has_skills' => [
                'required',
                'in:1,0',
            ],
            'specializations.*' => [
                'integer',
            ],
            'specializations' => [
                'required',
                'array',
            ],
            'working_hours' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'identity_number' => [
                'string',
                'required',
                'size:10',
                'regex:/(10)[0-9]{8}|(11)[0-9]{8}|(12)[0-9]{8}|(13)[0-9]{8}|(14)[0-9]{8}|(15)[0-9]{8}|(20)[0-9]{8}|(21)[0-9]{8}|(22)[0-9]{8}|(23)[0-9]{8}|(24)[0-9]{8}|(25)[0-9]{8}/',                
                
            ],
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
              //  'unique:users',
            ],
            'password' => [
                'required',
            ],
            'photo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048',
            ],
            'phone' => [
                'required',
                'size:10',
                'regex:/(05)[0-9]{8}/',
            ],
            'experience_years'=>
            [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'skills' => [
                'array',
            ],
            'health_status'=>
            [
                'required',
                'integer',
            ],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'cader',
            'phone' => $request->phone,
            'approved' => 0,
            'health_status' => $request->health_status,
        ]);

        $user->addMedia(request('photo'))->toMediaCollection('photo');

        $cawader = Cawader::create([
            'user_id' => $user->id,
            'dob' => $request->dob,
            'city_id' => $request->city_id,
            'has_skills' => $request->has_skills,
            'degree' => $request->degree,
            'desceiption' => $request->desceiption,
            'working_hours' => $request->working_hours,
            'identity_number' => $request->identity_number,
            'experience_years' => $request->experience_years,
        ]);

        $cawader->specializations()->sync($request->input('specializations', []));

        $cawader->skills()->sync($request->input('skills', []));

        return $this->returnSuccessMessage(trans('global.flash.api.registered'));

    }

    public function login(Request $request){

        $rules = [
            'phone' => 'required',
            'password' => 'required|min:6|max:20'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            if(Auth::user()->user_type == 'cader'){
                if(!Auth::user()->approved){
                    return $this->returnError('500',trans('global.yourAccountNeedsAdminApproval'));
                }
                $token = Auth::user()->createToken('user_token')->plainTextToken;
                $cawader = Cawader::where('user_id',Auth::id())->first();
                if($cawader->companies_and_institution_id != null){
                    return $this->returnError('500',trans('global.flash.api.not_authenticated'));
                }
                return $this->returnData(
                    [
                        'user_token' => $token,
                        'user_id '=> Auth::id(),
                        'cader_id' => $cawader->id,
                    ]
                );
            }else{
                return $this->returnError('500',trans('global.flash.api.not_authenticated'));
            }
        } else {
            return $this->returnError('500',trans('global.flash.api.invalid_user_or_password'));
        }
    }
}
