<?php

namespace App\Listeners;

use Throwable;
use App\Models\Message;
use Illuminate\Support\Arr;
use App\Events\SendMessageEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Support\SmsGateway\Contracts\SmsGatewayInterface;

class SendMessageListener implements ShouldQueue
{
    use SerializesModels, InteractsWithQueue;

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
     * @param  \App\Events\SendMessageEvent  $event
     * @return void
     */
    public function handle(SendMessageEvent $event)
    {
        $message = $this->createModel($event);
        try {
            $this->gateway->send(
                $event->getMessage(),
                $event->getPhoneNumber()
            );

            $this->handleSuccess($message);
        } catch (Throwable $exception) {
            $this->handleFailure($message, $exception, $event);
        }
    }

    /**
     * @param SendMessageEvent $event
     * 
     * @return Message
     */
    private function createModel(SendMessageEvent $event): Message
    {
        return Message::create([
            'message' => $event->getMessage(),
            'phone_number' => $event->getPhoneNumber(),
            'status' => Message::INIT_STATUS,
            'service' => Arr::last(explode('\\', get_class($this->gateway))),
        ]);
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
            'response' => 'ok'
        ]);
    }

    /**
     * @param Message $model
     * @param Throwable $exception
     * @param SendMessageEvent $event
     * 
     * @return void
     */
    private function handleFailure(Message $model, Throwable $exception, SendMessageEvent $event): void
    {
        $model->update([
            'status' => Message::FAILURE_STATUS,
            'response' => $exception->getMessage()
        ]);

        Log::critical($exception->getMessage(), [
            'message' => $event->getMessage(),
            'phone_number' => $event->getPhoneNumber(),
            'exception' => $exception,
        ]);
    }
}
