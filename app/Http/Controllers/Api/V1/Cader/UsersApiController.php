<?php

namespace App\Http\Controllers\Api\V1\Cader;

use App\Http\Controllers\Controller; 
use App\Models\User; 
use App\Models\Cawader; 
use App\Models\Event; 
use App\Models\BreakType; 
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\V1\Cader\CaderResource;
use App\Traits\api_return;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Resources\V1\Cader\BreakTypesResource;

class UsersApiController extends Controller
{
    use api_return;
    use MediaUploadingTrait; 

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
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();

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
            return $this->returnError('404',('Not Found !!!'));
        }

        $user->update($request->all()); 

        return $this->returnData(new CaderResource($user),__('Profile Updated Successfully'));
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
            return $this->returnError('401', 'Old Password Not Correct');
        }else{
            $user->password = bcrypt($request->password);
            $user->save();
            return $this->returnSuccessMessage(__('Changed Successfully'));
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
            return $this->returnError('404',('Not Found !!!'));

        $user->update($request->all());


        return $this->returnSuccessMessage(__('Token Updated Successfully'));
    } 
}