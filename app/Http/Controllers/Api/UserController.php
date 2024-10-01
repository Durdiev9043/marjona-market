<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function getMe()
    {
        $user = auth()->user();
        return $this->sendSuccess(new ProfileResource($user));
    }
}
