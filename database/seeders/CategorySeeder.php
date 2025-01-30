<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Administratë',
            'Agrikulturë dhe Industri Ushqimore',
            'Arkitekturë',
            'Art dhe Kulturë',
            'Banka',
            'Industria Automobilistike',
            'Retail dhe Distribuim',
            'Ndërtimtari & Patundshmëri',
            'Mbështetje e Konsumatorëve, Call Center',
            'Ekonomi, Financë, Kontabilitet',
            'Edukim, Shkencë & Hulumtim',
            'Punë të Përgjithshme',
            'Burime Njerëzore',
            'Teknologji e Informacionit',
            'Gazetari, Shtyp & Media',
            'Ligj & Legjislacion',
            'Menaxhment',
            'Marketing, Reklamim & PR',
            'Inxhinieri',
            'Shëndetësi, Medicinë',
            'Industri Farmaceutike',
            'Prodhim',
            'Shërbime Publike, Qeveritare',
            'Siguri & Mbrojtje',
            'Industri të Shërbimit',
            'Telekomunikim',
            'Tekstil, Lëkurë, Industri Veshëmbathjeje',
            'Gastronomi, Hoteleri, Turizëm',
            'Përkthim, Interpretim',
            'Transport, Logjistikë'
        ];
        
        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['name' => $category], 
                ['created_at' => now(), 'updated_at' => now()] 
            );
        }
    }
}
