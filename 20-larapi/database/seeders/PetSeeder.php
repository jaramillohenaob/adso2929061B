<?php

namespace Database\Seeders;

use App\Models\Pet;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        Pet::insert([
            [
                'name' => 'Milo',
                'image' => 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131?auto=format&fit=crop&w=900&q=80',
                'kind' => 'Perro',
                'weight' => '5',
                'age' => '2',
                'breed' => 'Labrador',
                'location' => 'Bogotá',
                'description' => 'Muy cariñoso y activo.',
                'active' => true,
                'adopted' => false,
            ],
            [
                'name' => 'Luna',
                'image' => 'https://images.unsplash.com/photo-1511044568932-338cba0ad803?auto=format&fit=crop&w=900&q=80',
                'kind' => 'Gato',
                'weight' => '3',
                'age' => '1',
                'breed' => 'Siamés',
                'location' => 'Medellín',
                'description' => 'Tranquila y elegante.',
                'active' => true,
                'adopted' => false,
            ],
            [
                'name' => 'Roco',
                'image' => 'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=900&q=80',
                'kind' => 'Perro',
                'weight' => '7',
                'age' => '4',
                'breed' => 'Golden',
                'location' => 'Cali',
                'description' => 'Amigable y divertido.',
                'active' => true,
                'adopted' => false,
            ],
        ]);
    }
}
