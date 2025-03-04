<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait BaseApiResponse
{
    public static function apiSuccess(
        $statusCode = Response::HTTP_OK,
        $message,
        $data = null,
        $status = "OK"
    ): JsonResponse {
        if ($message == null) {
            $meesage = 'Success';
        }
        return new JsonResponse([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public static function apiSuccessPagination(
        $statusCode = Response::HTTP_OK,
        string $message,
        $data = null,
        $pagination = null,
        $status = "OK"
    ): JsonResponse {
        if ($message == null) {
            $message = 'Success';
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'pagination' => $pagination
        ], $statusCode);
    }

    public static function apiFail(
        $statusCode,
        string $message,
        array $errors = [],
        $status = "BAD_REQUEST",
    ): JsonResponse {
        if ($message == null) {
            $message = 'Failed';
        }
        if ($statusCode == null) {
            $statusCode = Response::HTTP_BAD_REQUEST;
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    public static function apiError(
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        string $message,
        array $errors = [],
        $status = "INTERNAL_SERVER_ERROR",
    ): JsonResponse {
        if ($message == null) {
            $message = 'Internal Server Error';
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}