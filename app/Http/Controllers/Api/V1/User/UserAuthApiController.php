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
use Illuminate\Support\Facades\Http;
use App\Models\PasswordReset;
use Carbon\Carbon;


class UserAuthApiController extends Controller
{
    use api_return;
    use MediaUploadingTrait;

    public function send_sms_code(Request $request){

        $rules = [
            'phone' => 'required|size:10|regex:/(05)[0-9]{8}/',
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }


        $phone = $request->phone ? substr($request->phone, 1) : 0;

        $random_code = random_int(1000, 9999);

        $passwordReset = PasswordReset::where('email',$request->phone)->first();

        if(!$passwordReset){
            $passwordReset = PasswordReset::updateOrCreate(
                ['email' => $request->phone],
                [
                    'email' => $request->phone,
                    'token' => $random_code
                ]
            );
            $response =  Http::withHeaders([
                'Content-Type' =>   'application/json',
            ])->post('https://www.msegat.com/gw/sendsms.php', [
                "userName" => "tanthimco2022",
                "numbers" =>  "966".$phone,
                "userSender" => "Tanthim",
                "apiKey" => "15a07901abd2da24d240f4482d1ea3ab",
                "msg" => "رمز التفعيل الخاص بك في منصة تنظيم هو:". $random_code
            ]);
            if($response['code'] == '1'){
                return $this->returnData(['code' => $random_code]);
            }else{
                return $this->returnError('401', 'Error Code '.$response['code']);
            }
        }elseif (Carbon::parse($passwordReset->updated_at)->addMinutes(2)->isPast()) {


            $response =  Http::withHeaders([
                'Content-Type' =>   'application/json',
            ])->post('https://www.msegat.com/gw/sendsms.php', [
                "userName" => "tanthimco2022",
                "numbers" =>  "966".$phone,
                "userSender" => "Tanthim",
                "apiKey" => "15a07901abd2da24d240f4482d1ea3ab",
                "msg" => "رمز التفعيل الخاص بك في منصة تنظيم هو:". $random_code
            ]);
            if($response['code'] == '1'){
                return $this->returnData(['code' => $random_code]);
            }else{
                return $this->returnError('401', 'Error Code '.$response['code']);
            }
        }else{
            return $this->returnError('401', 'انتظر دقيقتين للأرسال مرة أخري');
        }

    }

    public function register(Request $request){

        $rules = [
            'name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:20',
            'national' => 'required|unique:visitors',
            'visitor_type' => 'in:individual,family_author,family_individual',
            'phone' => 'required|size:10|regex:/(05)[0-9]{8}/',
            'visitor_family.*.identity' => 'unique:visitors_families,identity'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }


        $validated_requests = $request->all();
        $validated_requests['password'] = bcrypt($request->password);
        $validated_requests['user_type'] = 'visitor';

        if($validated_requests['visitor_type'] == 'individual'){

            $user = User::create($validated_requests);
            $visitor = Visitor::create([
                'user_id' => $user->id,
                'national' => $validated_requests['national'],
                'visitor_type' => $validated_requests['visitor_type'],
            ]);

        }elseif($validated_requests['visitor_type'] == 'family_author'){


            $user = User::create($validated_requests);
            $visitor = Visitor::create([
                'user_id' => $user->id,
                'national' => $validated_requests['national'],
                'visitor_type' => $validated_requests['visitor_type'],
            ]);

            if($request->has('visitor_family')){
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
            }
        }elseif($validated_requests['visitor_type'] == 'family_individual'){
            $visitorFamily = VisitorsFamily::where('identity',$validated_requests['national'])->first();
            if($visitorFamily){
                $user = User::create($validated_requests);
                $visitor = Visitor::create([
                    'user_id' => $user->id,
                    'national' => $validated_requests['national'],
                    'visitor_type' => $validated_requests['visitor_type'],
                    'parent_id' => $visitorFamily->visitor_id,
                ]);
            }else{
                return $this->returnError('401', 'رقم الهوية غير مسجل لدينا');
            }
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
                return $this->returnError('500',trans('global.flash.api.not_authenticated'));
            }
        } else {
            return $this->returnError('500',trans('global.flash.api.invalid_user_or_password'));
        }
    }
}
