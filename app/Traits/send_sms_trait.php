<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;
use Config;


trait send_sms_trait
{

    public function sendSms($phone,$msg)
    {

        $phone = $phone ? substr($phone, 1) : 0;
                $response =  Http::withHeaders([
                            'Content-Type' =>   'application/json',
                        ])->post('https://www.msegat.com/gw/sendsms.php', [
                            "userName" => "tanthimco2022",
                            "numbers" =>  "966".$phone,
                            "userSender" => "Tanthim-AD",
                            "apiKey" => "08019771490cd9960d726674344dfe1e",
                            "msg" => $msg,
                        ]);
                    }

}
