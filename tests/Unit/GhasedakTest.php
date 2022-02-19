<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Support\SmsGateway\ResponseData;
use App\Support\SmsGateway\Drivers\Ghasedak;
use App\Support\SmsGateway\Exceptions\GatewayException;
use Mockery\MockInterface;

class GhasedakTest extends TestCase
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

        $driver = new Ghasedak();

        Http::fake([
            '*' => Http::response([
                [
                    "result" => "success",
                    "messageids" => 11509774
                ],
            ], 200),
        ]);

        $response = $driver->send($text, $phoneNumber);

        $this->assertInstanceOf(Ghasedak::class, $response);
        $this->assertInstanceOf(ResponseData::class, $response->getResponseData());
        $this->assertEquals(200, $response->getResponseData()->getStatus());
        $this->assertEquals('success', $response->getResponseData()->getMessage());
    }

    public function test_it_should_throws_exception_if_driver_is_broken(): void
    {
        $text = $this->faker()->sentence();
        $phoneNumber = $this->faker()->phoneNumber();

        $this->partialMock(Ghasedak::class, function (MockInterface $mock) {
            $mock->shouldReceive('fakeResponse')
                ->once()
                ->andReturn([
                    "result" => "error",
                    "messageids" => 1
                ]);
        });

        $driver = $this->app->make(Ghasedak::class);

        $this->expectException(GatewayException::class);
        $this->expectExceptionMessage('error');
        $this->expectExceptionCode(412);
        $driver->send($text, $phoneNumber);
    }
}
