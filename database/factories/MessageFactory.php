<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message' => $this->faker->sentence(),
            'phone_number' => $this->faker->phoneNumber(),
            'status' => Message::SUCCESS_STATUS,
            'response' => 'ok',
            'service' => 'sms',
        ];
    }
}
