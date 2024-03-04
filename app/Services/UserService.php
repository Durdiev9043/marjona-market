<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function make(array $params, string $role){
        $user = self::getUserByPhone($params['phone']);
        if (isset($user)){
            $user->assignRole($role);
        } else {
            if (isset($params['file'])) {
                $filename = UploadFile::uploadFile($params['file'], 'users');
            }
            $user = User::create([
                'name' => $params['name'],
                'surname' => $params['surname'],
                'phone' => $params['phone'],
                'image' => $filename ?? null,
                'password' => bcrypt($params['phone']),
                'selected_role' => $role,
                'status' => 1,
                'verify_code_status' => 2,
            ])->assignRole($role);
        }
        return $user;
    }

    public static function getUserByPhone(string $phone){
        return User::search($phone)->first();
    }
}
