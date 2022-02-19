<?php

namespace App\Listeners;

use Throwable;
use App\Models\Message;
use Illuminate\Support\Arr;
use App\Events\ResendMessageEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Support\SmsGateway\Contracts\SmsGatewayInterface;

class ResendMessageListener implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    
    /**
     * @var SmsGatewayInterface $gateway
     */
    private SmsGatewayInterface $gateway;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SmsGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ReResendMessageEvent  $event
     * @return void
     */
    public function handle(ResendMessageEvent $event)
    {
        try {
            $this->gateway->send(
                $event->getMessage()->message,
                $event->getMessage()->phone_number
            );

            $this->handleSuccess($event->getMessage());
        } catch (Throwable $exception) {
            $this->handleFailure($event->getMessage(), $exception, $event);
        }
    }

    /**
     * @param Message $model
     * 
     * @return void
     */
    private function handleSuccess(Message $model): void
    {
        $model->update([
            'status' => Message::SUCCESS_STATUS,
            'response' => 'ok',
            'service' => Arr::last(explode('\\', get_class($this->gateway))),
        ]);
    }

    /**
     * @param Message $model
     * @param Throwable $exception
     * @param ReSendMessageEvent $event
     * 
     * @return void
     */
    private function handleFailure(Message $model, Throwable $exception, ReSendMessageEvent $event): void
    {
        $model->update([
            'status' => Message::FAILURE_STATUS,
            'response' => $exception->getMessage()
        ]);

        Log::critical($exception->getMessage(), [
            'message' => $event->getMessage()->message,
            'phone_number' => $event->getMessage()->phone_number,
            'exception' => $exception,
        ]);
    }
}
