<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ORM -> Eloquent
        $user = new User;
        $user->document = '75000001';
        $user->fullname = 'Messi Ronaldo';
        $user->gender = 'male';
        $user->birthdate = '1990-05-20';
        $user->phone = '3001234567';
        $user->email = 'messironaldo@example.com';
        $user->password = bcrypt('admin');
        $user->role = 'administrator';
        $user->save();

        // Insert -> Array
        DB::table('users')->insert([
            'document' => '75000002',
            'fullname' => 'Neymar Junior',
            'gender' => 'male',
            'birthdate' => '1992-02-05',
            'phone' => '3007654321',
            'email' => 'neymarjunior@example.com',
            'password' => hash::make('admin'),
            'created_at' => now()
        ]);
    }
}
