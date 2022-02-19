<?php

namespace App\Support\SmsGateway\Contracts;

use App\Support\SmsGateway\ResponseData;

interface SmsGatewayInterface
{
    /**
     * Send a message.
     * 
     * @param string $message
     * @param string $recipient 
     * 
     * @return mixed
     */
    public function send(string $message, string $recipient): self;

    /**
     * The abstract function to get response from the API
     *
     * @return ResponseData The response object
     */
    public function getResponseData(): ResponseData;
}
