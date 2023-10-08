<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Niveau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ["effectif"=>20,"libelle"=>"ST1","niveau_id"=>Niveau::inRandomOrder()->first()->id,"filiere"=>"DEV WEB/MOBILE"],
            ["effectif"=>30,"libelle"=>"SRT1","niveau_id"=>Niveau::inRandomOrder()->first()->id,"filiere"=>"AWS"],
            ["effectif"=>35,"libelle"=>"SR0T1","niveau_id"=>Niveau::inRandomOrder()->first()->id,"filiere"=>"ANALYSE DE DONNEES"],
            ["effectif"=>50,"libelle"=>"SR0Tw1","niveau_id"=>Niveau::inRandomOrder()->first()->id,"filiere"=>"REFERENT DIGITAL"],

        ];
        Classe::insert($data);
    }
}
