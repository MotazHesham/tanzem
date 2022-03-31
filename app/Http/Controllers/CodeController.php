<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\PasswordReset;
use Carbon\Carbon;
use Auth;
use Alert;

class CodeController extends Controller
{
    public function send(Request $request){
        $user = Auth::user();
        $phone = $user->phone ? substr($user->phone, 1) : 0;

        $random_code = random_int(1000, 9999);

        $passwordReset = PasswordReset::where('email',$user->email)->first();

        if(!$passwordReset){
            $passwordReset = PasswordReset::updateOrCreate(
                ['email' => $user->email],
                [
                    'email' => $user->email,
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

            }else{
                Alert::error('Try Again','Error Code '.$response['code']);
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

            }else{
                Alert::error('Try Again','Error Code '.$response['code']);
            }
        }

        return view('auth.code');
    }

    public function verify(Request $request) {

        $user = Auth::user();

        $passwordReset = PasswordReset::where('email',$user->email)->first();

        if (!$passwordReset){
            Alert::error('Something Went Wrong','Try Again Later');
            return view('auth.code');
        }

        if($passwordReset->token != $request->code){
            Alert::error('الكود غير صحيح');
            return view('auth.code');
        }

        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();

        return redirect()->route('admin.home');
    }
}
