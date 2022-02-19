<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Support\SmsGateway\ResponseData;
use App\Support\SmsGateway\Drivers\KaveNegar;
use App\Support\SmsGateway\Exceptions\GatewayException;

class KaveNegarTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_send_message()
    {
        $text = $this->faker()->sentence();
        $phoneNumber = $this->faker()->phoneNumber();

        $driver = new KaveNegar();

        Http::fake([
            '*' => Http::response([
                'return' => [
                    'message' => 'ok',
                    'status' => 'success',
                    'code' => 200,
                ],
            ], 200),
        ]);

        $response = $driver->send($text, $phoneNumber);
        
        $this->assertInstanceOf(KaveNegar::class, $response);
        $this->assertInstanceOf(ResponseData::class, $response->getResponseData());
        $this->assertEquals(200, $response->getResponseData()->getStatus());
        $this->assertEquals('ok', $response->getResponseData()->getMessage());
    }

    public function test_it_should_throws_exception_if_driver_is_broken(): void
    {
        $text = $this->faker()->sentence();
        $phoneNumber = $this->faker()->phoneNumber();

        $driver = new KaveNegar();

        Http::fake([
            '*' => Http::response([
                'return' => [
                    'message' => 'error',
                    'status' => 'error',
                    'code' => 400,
                ],
            ], 400),
        ]);

        $this->expectException(GatewayException::class);
        $this->expectExceptionMessage('error');
        $this->expectExceptionCode(400);
        $driver->send($text, $phoneNumber);
    }
}
