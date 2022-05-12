<?php

namespace App\Traits;
use App\Models\UserAlert;
use App\Models\User;
use Illuminate\Support\Facades\Http;

trait push_notification
{

    public function send_notification( $title , $body , $alert_text , $alert_link , $type , $user_id, $add_to_alerts = true, $data = null)
    {
        $user = User::findOrFail($user_id);
        $key = 'key=AAAAgglWHgE:APA91bEUzDLzney0ogMIGkyLniomIso6G03MVGsogsYBW19E9VAr9NvFU9RUTlRALp8UgF5Yj7zrhhKuAc2RDGFzPhEGeEUV1lrvv8VDCIUUWStm9XE753Z1-JIgFNBQ0hjmfvniZwqS';

        if($add_to_alerts){
            $userAlert = UserAlert::create([
                'alert_text' => $alert_text,
                'alert_link' => $alert_link,
                'type' => $type,
            ]);

            $userAlert->users()->sync($user_id);
        }

        if($type == 'break'){
            Http::withHeaders([
                'Authorization' => $key,
                'Content-Type' =>   'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                "to" => $user->fcm_token,
                "collapse_key" => "type_a",
                "data" => [
                    "type" => $type,
                    "status" => $data,
                ],
                "notification" => [
                    "title"=> $title,
                    "body" => $body
                ]
            ]);
        }elseif($type == 'cader_request'){
            Http::withHeaders([
                'Authorization' => $key,
                'Content-Type' =>   'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                "to" => $user->fcm_token,
                "collapse_key" => "type_a",
                "data" => [
                    "type" => $type,
                    "status" => $data,
                ],
                "notification" => [
                    "title"=> $title,
                    "body" => $body
                ]
            ]);
        }
        else{
            Http::withHeaders([
                'Authorization' => $key,
                'Content-Type' =>   'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                "to" => $user->fcm_token,
                "collapse_key" => "type_a",
                "data" => [
                    "type" => $type,
                ],
                "notification" => [
                    "title"=> $title,
                    "body" => $body
                ]
            ]);
        }
    }
}
