<?php

namespace App\Traits;

use App\Events\NotificationEvent;
use App\Models\UserAlert;

trait push_web_notification
{

    public function send_web_notification( $alert_text , $alert_link , $type , $data , $user_id = null)
    {

        $data = [

            'alert_text' => $alert_text,
            'alert_link' => $alert_link,
            'type' => $type,
            'data' => $data,
        ];
           event(new NotificationEvent($data));

    }
}
