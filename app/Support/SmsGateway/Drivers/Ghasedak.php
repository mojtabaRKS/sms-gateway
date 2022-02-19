<?php

namespace App\Support\SmsGateway\Drivers;

use App\Support\SmsGateway\ResponseData;
use Symfony\Component\HttpFoundation\Response;
use App\Support\SmsGateway\Exceptions\GatewayException;
use App\Support\SmsGateway\Contracts\SmsGatewayInterface;

class Ghasedak implements SmsGatewayInterface
{
    private $baseUri;
    private $apiKey;
    private $from;
    private $response;

    public function __construct()
    {
        $this->baseUri = config('sms-gateway.drivers.ghasedak.uri');
        $this->apiKey = config('sms-gateway.drivers.ghasedak.credentials.api-key');
        $this->from = config('sms-gateway.drivers.ghasedak.credentials.from');
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
        // here we assume we called api and it was successful
        $result = $this->fakeResponse();
        
        if ($result['messageids'] <= 1000) {
            throw new GatewayException($result['result'], Response::HTTP_PRECONDITION_FAILED);
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
            ->setStatus(Response::HTTP_OK)
            ->setMessage($this->response['result']);
    }

    public function fakeResponse()
    {
        return [
            "result" => "success",
            "messageids" => 11509774
        ];
    }
}
