<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // $faker->paragraph();
            'name'=>fake()->numerify('event_####'),
            'description'=>fake()->paragraph(),
            'start_date'=>fake()->date('Y-m-d', '-10 years'),
            'end_date' => fake()->date('Y-m-d', '-10 years'),
            'place'=>fake()->name(),
            'address'=>fake()->sentence(),
            'city'=>fake()->word(),
            'image'=>fake()->image(null, 360, 360, 'animals', true),
            'status'=> true,
            'type'=>fake()->randomElement(['home', 'presencial']),
        ];
    }
}
