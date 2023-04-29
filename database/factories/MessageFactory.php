<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => fake()->firstName() . ' ' . fake()->lastName(),
            'phone_number' => fake()->phoneNumber(),
            'mail' => fake()->email(),
            'message' => fake()->paragraph(),
            'event_id' =>fake()->numberBetween(1, 10),
        ];
    }
}
