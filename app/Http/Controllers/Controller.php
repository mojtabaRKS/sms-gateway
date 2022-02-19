<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $message
     * @param int $code
     * @param mixed  $data
     *
     * @return JsonResponse
     */
    public function successResponse(string $message, int $code = Response::HTTP_OK, $data = []): JsonResponse
    {
        return response()->json([
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * @param string         $message
     * @param Throwable|null $exception
     *
     * @return JsonResponse
     */
    public function failureResponse(?Throwable $exception = null): JsonResponse
    {
        $code = Response::HTTP_INTERNAL_SERVER_ERROR;

        if (array_key_exists($exception->getCode(), Response::$statusTexts)) {
            $code = $exception->getCode();
        }

        if (config('app.debug')) {
            $data = [
                'Code' => $exception->getCode(),
                'Message' => $exception->getMessage(),
                'File' => $exception->getFile(),
                'Line' => $exception->getLine(),
                'Previous' => $exception->getPrevious(),
                'Trace' => $exception->getTrace(),
            ];
        }

        Log::critical($exception->getMessage(), $exception->getTrace());

        return response()->json([
            'code' => $code,
            'message' => $exception->getMessage(),
            'success' => false,
            'data' => $data ?? [],
        ], $code);
    }
}
