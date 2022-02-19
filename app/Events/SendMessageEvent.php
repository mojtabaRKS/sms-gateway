<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class SendMessageEvent
{
    use Dispatchable;

    /**
     * @var string $message
     */
    private string $message;

    /**
     * @var string $phoneNumber
     */
    private $phoneNumber;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $message, string $phoneNumber)
    {
        $this->message = $message;
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * Get the Message.
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Get the Phone Number.
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
