<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Visitor;
use App\Models\Contactu;
use App\Models\VisitorsFamily;
use Illuminate\Http\Request;
use App\Models\Report;
use Auth;
use App\Http\Resources\V1\User\UserResource;
use App\Traits\api_return;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\MediaUploadingTrait;

class UsersApiController extends Controller
{
    use api_return;
    use MediaUploadingTrait;

    public function contactus(Request $request){
        $rules = [
            'title' => 'required',
            'phone' => 'required|size:10|regex:/(05)[0-9]{8}/',
            'name' => 'required|string',
            'message' => 'required',
            'email' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }


        $contactus = Contactu::create([
            'title' => $request->title,
            'phone' => $request->phone,
            'name' => $request->name,
            'message' => $request->message,
            'email' => $request->email,
        ]);

        return $this->returnSuccessMessage(__('Sent Successfully'));
    }

    public function profile()
    {
        return $this->returnData(new UserResource(Auth::user()), "success");
    }

    public function update(Request $request){

        $rules = [
            'email' => 'required|unique:users,email,'.Auth::id(),
            'phone' => 'required|size:10|regex:/(05)[0-9]{8}/',
            'name' => 'required|string',
            'national' => 'required',
            'health_status'=> 'required|integer',

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

        if(!$user)
            return $this->returnError('404',trans('global.flash.api.not_found'));

        $user->update($request->all());

        $visitor = Visitor::where('user_id',$user->id)->first();
        $visitor->national = $request->national;
        $visitor->save();

        $user = User::find($user->id); // to solve problem photo is not return after update

        return $this->returnData(new UserResource($user),trans('global.flash.api.profile_updated'));
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
            return $this->returnError('401', trans('global.flash.api.old_password_not_correct'));
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

        $old_user=User::where('fcm_token',$request->fcm_token)->first();

        if($old_user)

        $old_user->update([
            'fcm_token' =>null,
        ]);
        $user = Auth::user();

        if(!$user)
            return $this->returnError('404',trans('global.flash.api.not_found'));

        $user->update($request->all());


        return $this->returnSuccessMessage('Token Updated Successfully');
    }

    public function report(Request $request){

        $rules = [
            'review_id' => 'required',
            'description' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        Report::create([
            'user_id'=>Auth::id(),
            'review_id'=>$request->review_id,
            'description'=>$request->description,
        ]);

        return $this->returnSuccessMessage('Report saved Successfully');

    }

}
