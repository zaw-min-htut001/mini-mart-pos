<?php

namespace App\Helpers;

class ResponseHelper {
    public static function success($data,$message='success')
    {
        return response()->json([
            'data' => $data,
            'message' => $message
        ],200);
    }

    public static function fail($data,$message='fail')
    {
        return response()->json([
            'data' => $data,
            'message' => $message
        ],422);
    }

    public static function error($message)
    {
        return response()->json([
            'message' => $message
        ],401);
    }
}
