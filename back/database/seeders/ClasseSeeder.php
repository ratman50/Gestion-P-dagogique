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
            ["libelle"=>"ST1","niveau_id"=>Niveau::inRandomOrder()->first()->id,"filiere"=>"DEV WEB/MOBILE"],
            ["libelle"=>"SRT1","niveau_id"=>Niveau::inRandomOrder()->first()->id,"filiere"=>"AWS"],
            ["libelle"=>"SR0T1","niveau_id"=>Niveau::inRandomOrder()->first()->id,"filiere"=>"ANALYSE DE DONNEES"],
            ["libelle"=>"SR0Tw1","niveau_id"=>Niveau::inRandomOrder()->first()->id,"filiere"=>"REFERENT DIGITAL"],

        ];
        Classe::insert($data);
    }
}
