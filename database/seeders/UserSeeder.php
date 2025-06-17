<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\City;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve available cities
        $cities = City::pluck('name')->all();

        // Create 10 fake users
        for ($i = 0; $i < 10; $i++) {
            // Define email and username patterns
            $email = $i === 0 ? 'user@mail.com' : "user{$i}@mail.com";
            $username = $i === 0 ? 'user' : "user{$i}";

            // Random profile data
            $city = $cities[array_rand($cities)];
            $height = rand(150, 200); // in cm
            $weight = rand(50, 100);  // in kg
            $gender = ['male', 'female'][array_rand(['male', 'female'])];
            $age = rand(18, 60);
            $size = rand(150, 200); // in cm
            $position = ['active', 'passive', 'versatile'][array_rand(['active', 'passive', 'versatile'])];
            $language = 'lt';

            // Generate random profile images via Pravatar
            $photo1 = "https://i.pravatar.cc/300?img=" . rand(1, 70);
            $photo2 = "https://i.pravatar.cc/300?img=" . rand(71, 140);
            $photo3 = "https://i.pravatar.cc/300?img=" . rand(141, 210);

            // Create the user
            User::create([
                'username' => $username,
                'email' => $email,
                'password' => Hash::make('Vaidas393!'),
                'city' => $city,
                'height' => $height,
                'weight' => $weight,
                'gender' => $gender,
                'age' => $age,
                'size' => $size,
                'position' => $position,
                'language' => $language,
                'photo1' => $photo1,
                'photo2' => $photo2,
                'photo3' => $photo3,
            ]);
        }
    }
}
