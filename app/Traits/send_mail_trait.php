<?php

namespace App\Traits;
use Config;
use Illuminate\Support\Facades\Mail;

trait send_mail_trait
{

    public function sendEmail($mailText, $email, $subject, $fileNameToStore = null)
    { 
        $fromName = "Tanthim";
        $fromAddress = "mails@tanthim.com";
        $fromPass = "E(U=DKYVu3%L";
        $fromDriver = "smtp";
        $fromHost = "tanthim.com";
        $fromPort = "587";
        $fromType = "tls";

        if ($fromDriver && $fromAddress) {
            Config::set('mail.username', $fromAddress);
            Config::set('mail.password', $fromPass);
            Config::set('mail.host', $fromHost);
            Config::set('mail.driver', $fromDriver);
            Config::set('mail.port', $fromPort);
            Config::set('mail.encryption', $fromType);
            Config::set('mail.from.address', $fromAddress);
            Config::set('mail.from.name', $fromName);

            if ($fileNameToStore != null) {
                $pdf = public_path('uploads/pdf/' . $fileNameToStore);
                Mail::send([], [], function ($message) use ($email, $subject, $mailText, $pdf) {
                    $message->to($email)->subject($subject)->setBody($mailText, 'text/html')->Attach(\Swift_Attachment::fromPath($pdf));
                });
            } else {
                Mail::send([], [], function ($message) use ($email, $subject, $mailText) {
                    $message->to($email)->subject($subject)->setBody($mailText, 'text/html');
                });
            }


            return true;
        } else {
            return false;
        }
    }

    public function custom_mail($email,$subject)
    {
        Mail::send('emails.echo',[], function($message) use ($email, $subject)
{
    $message->to($email,$subject )->subject($subject);
});
    }
}