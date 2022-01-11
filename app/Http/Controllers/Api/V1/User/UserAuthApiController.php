<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\User;
use App\Models\Visitor;
use App\Models\VisitorsFamily;
use Validator;
use Auth;
use App\Http\Controllers\Traits\MediaUploadingTrait; 


class UserAuthApiController extends Controller
{ 
    use api_return;
    use MediaUploadingTrait;

    public function register(Request $request){

        $rules = [
            'name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:20',
            'national' => 'required', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  

        $validated_requests = $request->all();
        $validated_requests['password'] = bcrypt($request->password);
        $validated_requests['user_type'] = 'visitor';

        $user = User::create($validated_requests);
        $visitor = Visitor::create([
            'user_id' => $user->id,
            'national' => $validated_requests['national'],
        ]);
        

        
        foreach($request->visitor_family as $family_member){
            VisitorsFamily::create([
                'visitor_id' => $visitor->id,
                'name' => $family_member['name'],
                'gender' => $family_member['gender'],
                'relation' => $family_member['relation'],
                'phone' => $family_member['phone'],
                'identity' => $family_member['identity'],
            ]);
        }

        $token = $user->createToken('user_token')->plainTextToken;

        return $this->returnData(
            [
                'user_token' => $token,
                'user_id '=> $user->id
            ]
        );

    }

    // -----------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------

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
            if(Auth::user()->user_type == 'visitor'){
                $token = Auth::user()->createToken('user_token')->plainTextToken; 
                return $this->returnData(
                    [
                        'user_token' => $token,
                        'user_id '=> Auth::id()
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
