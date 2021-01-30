<?php


namespace App\Domains\Account\Traits;


use App\Modules\Account\Mails\MailVerificationEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

trait sendMustVerifyEmail
{

    public function __construct()
    {
    }

    protected function sendVerificationMail($user)
    {

        $token = Str::random(255);

        $db = DB::delete("DELETE FROM `email_checks` WHERE email = '$user->email'");

        $db = DB::insert("INSERT INTO `email_checks` (email, token)
        VALUES('$user->email', '$token')"
        );

        $url = url(('https://app.simplifiqueii.com.br') . '/reset-password/' . $token) .
            '?email=' . urlencode($user->email);

        $notifiable =
            [
                'user' => $user,
                'token' => $token
            ];

        Mail::to('gabriel.santos@simplifiqueii.com.br')
            ->send(new MailVerificationEmail($notifiable));

    }
}
