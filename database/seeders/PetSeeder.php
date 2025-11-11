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
        // ORM -> Eloquent
        $pet = new Pet;
        $pet->name = 'Firulais';
        $pet->kind = 'dog';
        $pet->weight = 15.5;
        $pet->age = 3;
        $pet->breed = 'Labrador';
        $pet->location = 'Bogotá';  
        $pet->description = 'Friendly and playful dog looking for a loving home.';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Matias';
        $pet->kind = 'dog';
        $pet->weight = 3.5;
        $pet->age = 10;
        $pet->breed = 'Pincher Americano';
        $pet->location = 'Cali';
        $pet->description = 'Friendly and playful';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Botas';
        $pet->kind = 'cat';
        $pet->weight = 3.5;
        $pet->age = 1;
        $pet->breed = 'Siamese';
        $pet->location = 'Cali';
        $pet->description = 'playful and Friendly ';
        $pet->save();

        $pet = new Pet;
        $pet->name = 'Looney Tunes';
        $pet->kind = 'bird';
        $pet->weight = 10.5;
        $pet->age = 3;
        $pet->breed = 'Mini pig';
        $pet->location = 'Manizales';
        $pet->description = 'Fresh meat';
        $pet->save();
    }
}
