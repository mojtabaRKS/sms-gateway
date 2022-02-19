<?php

namespace App\Http\Controllers\Web;

use App\Models\Message;
use App\Services\V1\MessageService;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /**
     * @var MessageService
     */
    private MessageService $messageService;
    
    /**
     * Constructor.
     * 
     * @param MessageService $messageService
     */
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('messages.index', [
            'messages' => $this->messageService->getPaginated()
        ]);
    }

    /**
     * resend the specified message.
     */
    public function resend(Message $message)
    {
        $this->messageService->resend($message);
        return redirect()->route('messages.index');
    }
}
