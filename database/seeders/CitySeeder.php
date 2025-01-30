<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            'Prishtinë',
            'Prizren',
            'Pejë',
            'Mitrovicë',
            'Ferizaj',
            'Gjilan',
            'Gjakovë',
            'Vushtrri',
            'Podujevë',
            'Suharekë',
            'Rahovec',
            'Lipjan',
            'Malishevë',
            'Shtime',
            'Skenderaj',
            'Kamenicë',
            'Deçan',
            'Dragash',
            'Klinë',
            'Kaçanik',
            'Istog',
            'Fushë Kosovë',
            'Obiliq',
            'Viti',
            'Novobërdë',
            'Zubin Potok',
            'Zveçan',
            'Leposaviq',
            'Shterpcë'
        ];

        foreach ($cities as $city) {
            DB::table('cities')->updateOrInsert(
                ['name' => $city],
                ['created_at' => now(), 'updated_at' => now()] 
            );
        }
    }
}
