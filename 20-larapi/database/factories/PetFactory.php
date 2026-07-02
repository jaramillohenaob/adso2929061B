<?php

namespace Database\Factories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    protected $model = Pet::class;

    public function definition(): array
    {
        $kind = fake()->randomElement(['Perro', 'Gato']);
        $breed = $kind === 'Perro'
            ? fake()->randomElement(['Labrador', 'Golden', 'Bulldog', 'Beagle', 'Criollo'])
            : fake()->randomElement(['Siamés', 'Persa', 'Maine Coon', 'Bengal', 'Angora']);

        return [
            'name' => fake()->firstName(),
            'image' => 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131?auto=format&fit=crop&w=900&q=80',
            'kind' => $kind,
            'weight' => (string) fake()->numberBetween(2, 25),
            'age' => (string) fake()->numberBetween(1, 12),
            'breed' => $breed,
            'location' => fake()->randomElement(['Bogotá', 'Medellín', 'Cali', 'Barranquilla', 'Cartagena']),
            'description' => fake()->sentence(6),
            'active' => fake()->boolean(90),
            'adopted' => fake()->boolean(20),
        ];
    }
}
