<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\MessageService;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;


class RegisteredUserController extends Controller
{

    private MessageService $service;

    public function __construct(MessageService $messageService)
    {

        $this->service = $messageService;

    }



    public function create($role): View
    {

        return view('auth.register', compact('role'));

    }

    public function store(RegisterRequest $request)

    {

        $data =  $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required',
        ]);

        $code = rand(100000, 999999);

        if ($this->service->sendMessage($data['phone'], $code) != 200)

            return redirect()->back()->with('failed', 'invalid Phone');

        else {

//            if ($role != 'client')

                $role = 'client';

            $user = UserService::getUserByPhone($request->phone);

            if (isset($user)) {

                $user->assignRole($role);

            } else {

                $user = User::create([

                    'name' => $request->name,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'role' => 2,
                    'verify_code' => $code,
                    'verify_expiration' => now()->addMinutes(3),
                    'verify_code_status' => false

                ]);

                $user->assignRole($role);

            }

        }
return 'chotki';
//        return view('auth.check-sms', ['phone' => $user->phone]);

    }

    public function checkSms(Request $request, User $user)

    {
        if ($request->get('verify_code') == $user->verify_code && $user->verify_expiration > now()) {

            $user->update(['verify_code_status' => '1']);

            event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);

        } else {

            return redirect()->back()->with('error', 'Логин или пароль неправильно!');

        }

    }


    public function sendSms(Request $request)
    {

        $request->validate([
            'phone' => 'string|min:12|max:12'
        ]);

        $code = rand(100000, 999999);
        cache()->put($request->get('phone'), $code, 300);
        $this->service->sendMessage($request->get('phone'), $code);
        User::query()->where('phone', $request->get('phone'))->update([
            'verify_code' => $code,
            'verify_expiration' => now()->addMinutes(3),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Code sent!'
        ]);

    }

}
