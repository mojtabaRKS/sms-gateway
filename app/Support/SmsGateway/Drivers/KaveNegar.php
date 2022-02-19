<?php

namespace App\Support\SmsGateway\Drivers;

use Illuminate\Support\Facades\Http;
use App\Support\SmsGateway\ResponseData;
use Symfony\Component\HttpFoundation\Response;
use App\Support\SmsGateway\Exceptions\GatewayException;
use App\Support\SmsGateway\Contracts\SmsGatewayInterface;

class KaveNegar implements SmsGatewayInterface
{
    public $baseUri;
    public $apiKey;
    public $from;
    private $response;

    /**
     * kavenegar driver constructor.  
     */
    public function __construct()
    {
        $this->baseUri = config('sms-gateway.drivers.kaveNegar.uri');
        $this->apiKey = config('sms-gateway.drivers.kaveNegar.credentials.api-key');
        $this->from = config('sms-gateway.drivers.kaveNegar.credentials.from');
    }

    /**
     * Send a message.
     * 
     * @param string $message
     * @param string $recipient 
     * 
     * @return mixed
     */
    public function send(string $message, string $recipient): self
    {
        $result = Http::post(
            $this->baseUri .
                $this->apiKey .
                '/sms/send.json?receptor=' .
                $recipient .
                '&message=' .
                $message .
                '&sender=' .
                $this->from
        );

        if ($result->status() !== Response::HTTP_OK) {
            throw new GatewayException($result['return']['message'], $result->status());
        }

        $this->response = $result;

        return $this;
    }

    /**
     * The abstract function to get response from the API
     *
     * @return ResponseData The response object
     */
    public function getResponseData(): ResponseData
    {
        return (new ResponseData)
            ->setStatus($this->response->status())
            ->setMessage($this->response['return']['message']);
    }
}
