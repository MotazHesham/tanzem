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

    public function login(Request $request){

        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(Auth::user()->user_type == 'cader'){
                $token = Auth::user()->createToken('user_token')->plainTextToken; 
                $cawader = Cawader::where('user_id',Auth::id())->first();
                return $this->returnData(
                    [
                        'user_token' => $token,
                        'user_id '=> Auth::id(),
                        'cader_id' => $cawader->id,
                    ]
                );
            }else{
                return $this->returnError('500',__('Not Authenticated to use this app'));
            }
        } else {
            return $this->returnError('500',__('invalid username or password'));
        }
    }
}
