<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Vilnius',
            'Kaunas',
            'Klaipėda',
            'Šiauliai',
            'Panevėžys',
            'Alytus',
            'Marijampolė',
            'Mažeikiai',
            'Jonava',
            'Utena',
            'Kėdainiai',
            'Telšiai',
            'Tauragė',
            'Ukmergė',
            'Visaginas',
            'Plungė',
            'Kretinga',
            'Šilutė',
            'Palanga',
            'Rokiškis',
            'Radviliškis',
            'Biržai',
            'Druskininkai',
            'Elektrėnai',
            'Joniškis',
            'Jurbarkas',
            'Molėtai',
            'Neringa',
            'Šilalė',
            'Pasvalys',
        ];

        foreach ($cities as $name) {
            City::firstOrCreate(['name' => $name]);
        }
    }
}
