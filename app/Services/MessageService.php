<?php

namespace App\Services;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;


class MessageService {

    public function refreshToken() {
        $response = Http::patch("notify.eskiz.uz/api/auth/refresh")->json();
        return $response['data']['token'];
    }

    public function sendMessage($phone, $message) {

        $token = $this->getToken();
$msg='Marjona oziq ovqat dokonining kirinsh kodi:'.$message;
        if ($phone != '998999999999') {
            $res = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post("http://notify.eskiz.uz/api/message/sms/send", [
                'mobile_phone' => "$phone",
                'message' => $msg,
                'from' => '4546',
                //'callback_url' => route('receive_status')
            ]);

            return $res->status();

        }
        else{
            dd($phone);
        }

    }

    public function getToken() {

//        $response = Http::post("notify.eskiz.uz/api/auth/login", [
//            'email' => config('donyorbek9043@gmail.com'),
//            'password' => config('i1DYvprVps4rFJRr6nTsbV2Io8ca7AqXl5ZTi90R'),
//        ])->json();

        return 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3MTE4ODkwMjQsImlhdCI6MTcwOTI5NzAyNCwicm9sZSI6InRlc3QiLCJzaWduIjoiNjEyYTM5ZmUyZmVhNzdlNjdhZjViZjE2YzlmNTAzZmExM2ZjMGFmNWQxZWExNjNhYzNiNzAzMDIyODA5YmM0MiIsInN1YiI6IjY2MDYifQ.4f9ZiVxqoeHTuw6cToAiQi5TyKWAv8VuOXwImx-ysk4';

    }

    public function receive(Request $request) {// EXPIRED
        if ($request->get('status') != "DELIVRD")
            Cache::put('token', $this->getToken());
    }
}
