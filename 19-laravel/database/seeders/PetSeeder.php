<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new Pet;
        $user->name = 'Michifu';
        $user->kind = 'Cat';
        $user->weight = 3.5;
        $user->age = 2;
        $user->breed = 'Siamese';
        $user->location = 'Bogotá';
        $user->description = 'friendly';
        $user->save();
        
        $user = new Pet;
        $user->name = 'Rex';
        $user->kind = 'Dog';
        $user->weight = 10.2;
        $user->age = 4;
        $user->breed = 'Labrador';
        $user->location = 'Medellín';
        $user->description = 'playful';
        $user->save();

        $user = new Pet;
        $user->name = 'Tuetano';
        $user->kind = 'Cat';
        $user->weight = 4.0;
        $user->age = 3;
        $user->breed = 'Persian';
        $user->location = 'Cali';
        $user->description = 'calm';
        $user->save();

        $user = new Pet;
        $user->name = 'Sancocho';
        $user->kind = 'Dog';
        $user->weight = 8.5;
        $user->age = 5;
        $user->breed = 'Criollo';
        $user->location = 'Bogotá';
        $user->description = 'energetic';
        $user->save();
    }
}
