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
            'tilte'=>fake()->numerify('event_####'),
            'description'=>fake()->paragraph(),
            'start_date'=>fake()->date('Y-m-d', '-10 years'),
            'end_date' => fake()->date('Y-m-d', '-10 years'),
            'place'=>fake()->name(),
            'address'=>fake()->sentence(),
            'city'=>fake()->word(),
            'image'=>'/images/DKPVp2qh2bc77noircu9VH2foC2tRUQBoMYaJw5z.png',
            'status'=> true,
            'type'=>fake()->randomElement(['en-linea', 'presencial']),
        ];
    }
}
