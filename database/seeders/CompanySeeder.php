<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanySeeder extends Seeder
{
    public function run()
    {
        $companies = [
            [
                'name' => 'Viva Fresh Store',
                'image' => 'companies/viva_fresh_store.jpg',
            ],
            [
                'name' => 'Albi Mall',
                'image' => 'companies/albi_mall.jpg',
            ],
            [
                'name' => 'ETC',
                'image' => 'companies/etc.png',
            ],
            [
                'name' => 'Neptun',
                'image' => 'companies/neptun.jpg',
            ],
            [
                'name' => 'Teleperformance Kosova',
                'image' => 'companies/teleperformance.png',
            ],
            [
                'name' => 'HIB Petrol',
                'image' => 'companies/hib_petrol.jpg',
            ],
            [
                'name' => 'Burger King',
                'image' => 'companies/burger_king.jpg',
            ],
            [
                'name' => 'Super Viva',
                'image' => 'companies/super_viva.png',
            ],
            [
                'name' => 'Banka për Biznes',
                'image' => 'companies/banka_per_biznes.png',
            ],
            [
                'name' => 'Telkos',
                'image' => 'companies/telkos.jpg',
            ],
            [
                'name' => 'Emona Center',
                'image' => 'companies/emonacenter.jpg',
            ],
        ];

        foreach ($companies as $company) {
            DB::table('companies')->updateOrInsert(
                ['name' => $company['name']], 
                [
                    'image' => $company['image'], 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
