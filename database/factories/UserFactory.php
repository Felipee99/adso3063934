<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $maleNames = ['Santiago', 'Sebastián', 'Diego', 'Nicolás', 'Samuel',
            'Alejandro', 'Daniel', 'Mateo', 'Ángel', 'Miguel', 'Juan', 'José',
            'Luis', 'Carlos', 'Jorge', 'Fernando', 'Ricardo', 'Francisco',
            'David', 'Antonio'];
        
        $femaleNames = ['Sofía', 'Isabella', 'Valentina', 'Emma', 'Camila',
            'María', 'Lucía', 'Martina', 'Daniela', 'Sara', 'Ana', 'Paula',
            'Carmen', 'Julia', 'Laura', 'Andrea', 'Elena', 'Patricia',
            'Rosa', 'Isabel'];

        // Primero decidimos el género
        $gender = fake()->randomElement(['male', 'female']);
        
        // Seleccionamos un nombre según el género
        $firstName = $gender === 'male' 
            ? fake()->randomElement($maleNames)
            : fake()->randomElement($femaleNames);
        
        $url = $gender === 'male'
            ? 'https://randomuser.me/api/portraits/men/' . fake()->numberBetween(1, 99) . '.jpg'
            : 'https://randomuser.me/api/portraits/women/' . fake()->numberBetween(1, 99) . '.jpg';

        // Nombre único para guardar la imagen localmente
        $imageName = 'user_' . uniqid() . '.jpg';
        $imagePath = public_path('images/' . $imageName);

        // Descargar la imagen y guardarla en public/images
        file_put_contents($imagePath, file_get_contents($url));

        return [
            'document' => fake()->numerify('75########'),
            'fullname' => $firstName . ' ' . fake()->lastName(),
            'gender' => $gender,
            'birthdate' => fake()->date(),
            'photo' => 'images/' . $imageName, // se guarda la ruta local
            'phone' => fake()->numerify('300########'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
