<?php

namespace App\Custom;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data = null, $message = 'Successful', $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function failed($message = 'Failed', $data = null, $code = 400): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public static function validationFailed($errors, $message = 'Validation errors', $code = 422): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $errors,
        ], $code);
    }

    public static function unauthorized($message = 'Unauthorized', $code = 401): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => null,
        ], $code);
    }

    public static function notFound($message = 'Resource not found', $code = 404): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => null,
        ], $code);
    }
}
