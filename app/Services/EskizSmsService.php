<?php

namespace App\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class EskizSmsService
{
    public function login()
    {
        $response = Http::post(config('eskiz.host') . '/auth/login', [
            'email'    => config('eskiz.email'),
            'password' => config('eskiz.password'),
        ]);

        cache()->put('eskiz_bearer_token', $response->json()['data']['token'], 3600 * 24);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws RequestException
     * @throws NotFoundExceptionInterface
     */
    public function send($phone, $message)
    {
        $response = Http::withHeaders([
                                          'Authorization' => 'Bearer ' . cache()->get('eskiz_bearer_token'),
                                      ])
            ->post(config('eskiz.host') . '/message/sms/send', [
                'mobile_phone' => $phone,
                'message'      => $message,
                'from'         => config('eskiz.from'),
            ]);

        if ($response->status() == 401) {
            $this->login();
            $response = $this->send($phone, $message);
        }

        return $response;
    }
}
