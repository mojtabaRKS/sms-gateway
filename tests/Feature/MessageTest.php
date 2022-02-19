<?php

namespace Tests\Feature;

use App\Events\ResendMessageEvent;
use Tests\TestCase;
use App\Models\Message;
use App\Models\User;
use App\Services\V1\MessageService;
use Mockery\MockInterface;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpFoundation\Response;
use App\Support\SmsGateway\Exceptions\GatewayException;
use App\Support\SmsGateway\Contracts\SmsGatewayInterface;
use Exception;
use Illuminate\Support\Facades\Event;

class MessageTest extends TestCase
{
    public function test_can_send_a_new_message(): void
    {
        $message = $this->faker->word();
        $phone_number = $this->faker->phoneNumber();

        $this->mock(SmsGatewayInterface::class, function (MockInterface $mock) use ($message, $phone_number) {
            $mock->shouldReceive('send')
                ->once()
                ->withArgs([$message, $phone_number])
                ->andReturnSelf();
        });

        $response = $this->postJson(route('api.v1.messages.send'), [
            'message' => $message,
            'phone_number' => $phone_number,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson(function (AssertableJson $json) {
            $json->where('success', true)
                ->where('code', Response::HTTP_CREATED)
                ->where('message', trans('messages.ok'))
                ->where('data', []);
        });

        $this->assertDatabaseHas('messages', [
            'message' => $message,
            'phone_number' => $phone_number,
            'status' => Message::SUCCESS_STATUS,
            'response' => 'ok'
        ]);
    }

    public function test_can_save_failed_message(): void
    {
        $message = $this->faker->word();
        $phone_number = $this->faker->phoneNumber();
        $exception_message = $this->faker->sentence();

        $this->mock(SmsGatewayInterface::class, function (MockInterface $mock) use ($message, $phone_number, $exception_message) {
            $mock->shouldReceive('send')
                ->once()
                ->withArgs([$message, $phone_number])
                ->andThrows(GatewayException::class, $exception_message, Response::HTTP_PRECONDITION_FAILED);
        });

        $response = $this->postJson(route('api.v1.messages.send'), [
            'message' => $message,
            'phone_number' => $phone_number,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson(function (AssertableJson $json) {
            $json->where('success', true)
                ->where('code', Response::HTTP_CREATED)
                ->where('message', trans('messages.ok'))
                ->where('data', []);
        });

        $this->assertDatabaseHas('messages', [
            'message' => $message,
            'phone_number' => $phone_number,
            'status' => Message::FAILURE_STATUS,
            'response' => $exception_message
        ]);
    }

    public function test_it_should_return_response_if_service_is_broken(): void
    {
        $this->mock(MessageService::class, function (MockInterface $mock) {
            $mock->shouldReceive('send')
                ->once()
                ->andThrows(Exception::class, 'failed', 400);
        });

        $response = $this->postJson(route('api.v1.messages.send'), [
            'message' => $this->faker->word(),
            'phone_number' => $this->faker->phoneNumber(),
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJson(function (AssertableJson $json) {
            $json->where('success', false)
                ->where('code', Response::HTTP_BAD_REQUEST)
                ->where('message', 'failed')
                ->where('data', []);
        });
    }

}
