<?php

namespace App\Services\V1;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\SendMessageEvent;
use App\Events\ResendMessageEvent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MessageService
{
    /**
     * @param Request $request
     * 
     * return void
     */
    public function send(Request $request): void
    {
        event(new SendMessageEvent(
            $request->input('message'),
            $request->input('phone_number')
        ));
    }

    /**
     * @param Message $message
     * 
     * @return void
     */
    public function resend(Message $message): void
    {
        event(new ReSendMessageEvent($message));
    }

    /** 
     * return LengthAwarePaginator
     */
    public function getPaginated(): LengthAwarePaginator
    {
        return Message::paginate();
    }
}
