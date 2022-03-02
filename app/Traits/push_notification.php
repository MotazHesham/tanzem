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
        $key = 'key=AAAADJS7ZUc:APA91bGdlHaJEes0B2jJSRk5GgJF5DXI-45uNmDT1LtLo6Z9ZF8DvLW8UZnS9u_yQ9llOsFgQgE8QeU_R2SS7w_mpf166Jid9_5AUMp8OxfGLc13-XDqUPKOqHXMJWcjZfOGZVIP7lRB';

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
                    "route" => $data,
                ],
                "notification" => [
                    "title"=> $title,
                    "body" => $body
                ]
            ]);
        }else{
            Http::withHeaders([
                'Authorization' => $key,
                'Content-Type' =>   'application/json',
            ])->post('https://fcm.googleapis.com/fcm/send', [
                "to" => $user->fcm_token,
                "collapse_key" => "type_a",
                "notification" => [
                    "title"=> $title,
                    "body" => $body
                ]
            ]);
        }
    }
}