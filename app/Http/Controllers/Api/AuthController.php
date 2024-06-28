<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\MessageService;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    private MessageService $service;

    public function __construct(MessageService $messageService)
    {

        $this->service = $messageService;

    }

    public function reg(Request $request){
        $data =  $request->validate([
            'phone' => 'required',
        ]);
        $smsphone='+998'.$data['phone'];
//        $code = rand(1000, 9999);
        $code=7777;
        $us=User::where('phone',$request->phone)->first();

        if ($us){

            if ($this->service->sendMessage($smsphone, $code) != 200)
            {
                redirect()->back()->with('failed', 'invalid Phone');
            }
            $us->update([
                'verify_code' => $code,
                'verify_expiration' => now()->addMinutes(3),
            ]);
            $res = [
                'success' => true,
                'data' => $request->phone,
                'message' => 'telefon raqam saqlandi',
            ];

            return response()->json($res, 200);
        }else{
//            if ($this->service->sendMessage($smsphone, $code) != 200)
//            {
//                redirect()->back()->with('failed', 'invalid Phone');
//            }
//            else {
                $role = 'client';
                $user = User::create([
                    'phone' => $request->phone,
                    'role' => '2',
                    'verify_code' => $code,
                    'verify_expiration' => now()->addMinutes(3),
                    'verify_code_status' => false
                ]);
                $user->assignRole($role);
//            }
            $res = [
                'success' => true,
                'data' => $request->phone,
                'message' => 'telefon qaqam saqlandi',
            ];

            return response()->json($res, 200);
    }
    }

    public function checkSms(Request $request, $phone)

    {
        $user=User::where('phone',$phone)->first();
        if ($request->get('verify_code') == $user->verify_code && $user->verify_expiration > now()) {

            $user->update(['verify_code_status' => '1']);

            event(new Registered($user));

            Auth::login($user);

            if ($user)
            {
                $role=User::where('phone', $request->phone)->first()->role;
                $user_id=User::where('phone', $request->phone)->first()->id;
                $name=User::where('phone', $request->phone)->first()->name;
                $phone=User::where('phone', $request->phone)->first()->phone;
            }
            $data=[
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'role' => $role,
                'user_id'=>$user_id,
                'name'=>$name,
                'phone'=>$phone
            ];
            return response()->json([
                'success' => true,
                'message' => 'User Logged In Successfully',
                'data' => $data
            ], 200);

        } else {

            return redirect()->back()->with('error', 'Логин или пароль неправильно!');

        }

    }

    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'phone' => 'required',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return response()->json([


                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['phone', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Phone & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('phone', $request->phone)->first();
            if ($user)
            {
                $role=User::where('phone', $request->phone)->first()->role;
                $user_id=User::where('phone', $request->phone)->first()->id;
                $name=User::where('phone', $request->phone)->first()->name;
                $phone=User::where('phone', $request->phone)->first()->phone;
            }
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'role' => $role,
                'user_id'=>$user_id,
                'name'=>$name,
                'phone'=>$phone
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function loginCourier(Request $request)

    {
        try {
            $validateUser = Validator::make($request->all(),
                [
                    'phone' => 'required',
                    'password' => 'required'
                ]);

            if($validateUser->fails()){
                return response()->json([


                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user=User::where('role',3)->where('phone',$request->phone)->first();

//            $user = User::where('phone', $request->phone)->first();

            if ($user) {
                $role = User::where('phone', $request->phone)->first()->role;
                $user_id = User::where('phone', $request->phone)->first()->id;
                $name = User::where('phone', $request->phone)->first()->name;
                $phone = User::where('phone', $request->phone)->first()->phone;

                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken,
                    'role' => $role,
                    'user_id' => $user_id,
                    'name' => $name,
                    'phone' => $phone
                ], 200);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Phone & Password does not match with our record.',
                ], 401);
            }

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}

