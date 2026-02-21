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
        $petNames = ["Luna","Max","Bella","Rocky","Milo","Coco","Nala","Simba","Toby","Lola","Zeus","Kira","Thor","Mía","Bruno","Daisy","Leo","Chloe","Oliver","Canela","Buddy","Rex","Bobby","Pelusa","Oreo","Kiara","Apolo","Blue","Gala","Balu","Sasha","Romeo","Princesa","Jack","Nina","Pancho","Lucky","Layla","Benji","Sam","Koko","Teo","Frida","Tina","Scooby","Chispa","Duke","Loki","Gordo","Rocco"];
        $dogBreeds=["Labrador Retriever","Pastor Alemán","Bulldog Francés","Golden Retriever","Poodle"];    
        $catBreeds=["Siamés","Persa","Maine Coon","Bengalí","Ragdoll"];
        $pigBreeds=["Yorkshire","Duroc","Hampshire","Landrace","Pietrain"];
        $birdBreeds=["Canario","Periquito Australiano","Guacamayo","Cacatúa","Jilguero"];

        $kind = fake()->randomElement(['dog', 'cat', 'bird', 'pig']);

        switch ($kind) {
            case 'dog':
                $breed = fake()->randomElement($dogBreeds);
                break;
            case 'cat':
                $breed = fake()->randomElement($catBreeds);
                break;
            case 'pig':
                $breed = fake()->randomElement($pigBreeds);
                break;
                default:
                $breed = fake()->randomElement($birdBreeds);
                break;
        }

        return [
        'name'        => fake()->randomElement($petNames),
        'kind'        => $kind,
        'weight'      => fake()->numerify('#.#'),
        'age'         => fake()->numberBetween(1, 15),
        'breed'       => $breed,
        'location'    => fake()->city(),
        'description' => fake()->sentence(5),
        ];
    }
}
