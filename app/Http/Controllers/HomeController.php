<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $newOrderCount = Order::query()
            ->where('status', 1)
            ->count();

        $clientCount = User::query()
            ->where('role', 2)
            ->count();

        $responseTimeWeb = Http::withHeaders([
                                                 'Accept'        => 'application/json',
                                                 'Content-Type'  => 'application/json',
                                                 'Authorization' => 'Bearer eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCIsImtpZCI6IjFrYnhacFJNQGJSI0tSbE1xS1lqIn0.eyJ1c2VyIjoiYnQwODQ4OSIsInR5cGUiOiJhcGlfa2V5IiwicG9ydGFsX3Rva2VuIjoiNjM5MjM5MDktODcyOC00OTAxLWJhODUtMmRmMDY1NjQwNGZlIiwiYXBpX2tleV9pZCI6IjljNTljZjI4LTEyMWQtNDBlYi1hZTM4LWJlZTJiMjFhMGQ2MSIsImlhdCI6MTcyODI0MjM4NX0.AM9M5ZP69TWz-m_kb2d0I3LTlg6Sbstgq0zUjmJrcn2JQa0zv5xtZP5y1pM8E_o6D0gb3Mu1DQrxnEu_A6mg1axqG1bY-CdiJRNJlwKqJ9yHyHHTKHIrVhx1mvgprFGVwNc0bOktXrfJGFSdyQM4wdfYlQmlBBANCLK4keqXGmjxd6-KZAO2gujzi36LJzkW3e4f8cP7P1r23VafI6wlAF3N2CjwX-lKjYqulHF8kui9zLS1nokDrZRn8xZobJj6RvWXTEEoEhZNlA9UYHX-qqgDhN52xGwlE9x-6W5QGRBZI1ggnfUvQZKaFQTwQj_gKrss4lQ5PM9aFub5nHvsojjyZ_3oF9_F6oeCi0yGWoeIiQr3kyuhhaUEW_XQADxd_4ARZf6YFckjERVRVuhaq_5CzYE4ojN1FIm-oaSqjA5m4r3bDKeXEd7x9HZ_KU7yrYHk5GClMupbQBV6I3lS7xMq2RLxztrUBHiMh6WfJ8-1ODeG_jomYlAnrxL2BJMK',
                                             ])->get('https://api.timeweb.cloud/api/v1/account/finances');
        $serverBalance   = $responseTimeWeb->json()['finances']['balance'];

        if (cache()->get('eskiz_bearer_token') == null) {
            $responseEskiz = Http::withHeaders([
                                                   'Accept'       => 'application/json',
                                                   'Content-Type' => 'application/json',
                                               ])
                ->post(config('eskiz.host') . '/auth/login', [
                    'email'    => config('eskiz.email'),
                    'password' => config('eskiz.password')
                ]);
            cache()->put('eskiz_bearer_token', $responseEskiz->json()['data']['token'], 3600 * 24);
        }

        $responseEskiz = Http::withHeaders([
                                               'Accept'       => 'application/json',
                                               'Content-Type' => 'application/json',
                                               'Authorization' => 'Bearer ' . cache()->get('eskiz_bearer_token')
                                           ])
            ->get(config('eskiz.host') . '/user/get-limit');
        $eskizBalance = $responseEskiz->json()['data']['balance'];

        return view('admin.dashboard', compact(
            'newOrderCount',
            'clientCount',
            'serverBalance',
            'eskizBalance'
        ));
    }
}
