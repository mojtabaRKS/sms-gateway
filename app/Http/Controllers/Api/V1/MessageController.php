<?php

namespace App\Http\Controllers\Api\V1;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Services\V1\MessageService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\MessageRequest;

class MessageController extends Controller
{
    /**
     * @var MessageService
     */
    private $service;

    /**
     * MessageController constructor.
     *
     * @param MessageService $service
     */
    public function __construct(MessageService $service)
    {
        $this->service = $service;
    }

    /**
     * @param MessageRequest $request
     * 
     * @return JsonResponse
     */
    public function send(MessageRequest $request): JsonResponse
    {
        try {
            $this->service->send($request);
            return $this->successResponse(
                trans('messages.ok'),
                Response::HTTP_CREATED
            );
        } catch (Throwable $exception) {
            return $this->failureResponse($exception);
        }
    }
}
