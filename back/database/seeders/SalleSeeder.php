<?php

namespace Database\Seeders;

use App\Models\Salle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $salles=[
           [ "libelle"=>"salle 1","places"=>60],
           [ "libelle"=>"salle 2","places"=>25],
           [ "libelle"=>"salle 3","places"=>19],
           [ "libelle"=>"salle 4","places"=>28],
           [ "libelle"=>"salle 5","places"=>60],
           [ "libelle"=>"salle 6","places"=>29],
           [ "libelle"=>"salle 7","places"=>50],

        ];
        Salle::insert($salles);
    }
}
