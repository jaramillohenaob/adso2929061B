<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $gender = fake()->randomElement(['male', 'female']);
        // $document = fake()->unique()->numerify('75######');

        //     $image = Http::get('https://thispersondoesnotexist.com/')->body();
        //     $fileName = $document . '.png';
        //     file_put_contents(public_path('images/' . $fileName), $image);

        // return [
        //     'document' => $document,
        //     'fullname' => fake()->firstName($gender). ' '.fake()->lastName(),
        //     'gender' => ucfirst($gender),
        //     'birthdate' => fake()->dateTimeBetween('1976-01-01', '2006-12-31'),
        //     'phone' => fake()->unique()->numerify('310#######'),
        //     'email' => fake()->unique()->safeEmail(),
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('12345'),
        //     'remember_token' => Str::random(10),
        //     'photo' => $fileName
        // ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
