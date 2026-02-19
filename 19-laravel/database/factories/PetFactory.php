<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombresMascotas = ["Luna","Max","Bella","Rocky","Milo","Coco","Nala","Simba","Toby","Lola","Zeus","Kira","Thor","Mía","Bruno","Daisy","Leo","Chloe","Oliver","Canela","Buddy","Rex","Bobby","Pelusa","Oreo","Kiara","Apolo","Blue","Gala","Balu","Sasha","Romeo","Princesa","Jack","Nina","Pancho","Lucky","Layla","Benji","Sam","Koko","Teo","Frida","Tina","Scooby","Chispa","Duke","Loki","Gordo","Rocco"];


        return [
        'name'        => fake()->ColorName(),
        'kind'        => fake()->randomElement(['dog', 'cat', 'bird', 'pig']),
        'weight'      => fake()->numerify('#.#'),
        'age'         => fake()->numberBetween(1, 15),
        'breed'       => fake()->randomElement(['Type1', 'Type2', 'Type3', 'Type4']),
        'location'    => fake()->city(),
        'description' => fake()->sentence(5),
        ];
    }
}
