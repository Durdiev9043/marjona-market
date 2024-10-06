<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller {
    public function sendSuccess($data, $msg = 'Success', $success = true) {
        $res = [
            'success' => $success,
            'data' => $data,
            'message' => $msg,
        ];

        return response()->json($res,200);
    }

    public function sendError($error, $errorMsg = [], $code = 200) {
        $res = [
            'success' => false,
            'message' => $error,
        ];
        if (!empty($errorMsg)) {
            $res['data'] = $errorMsg;
        }
        return response()->json($res, $code);
    }
}
