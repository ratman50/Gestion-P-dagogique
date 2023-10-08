<?php

namespace Database\Seeders;

use App\Models\Param;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ["annee_scolaire_id"=>1,"semestre_id"=>1,"classe_id"=>1,"actif"=>1],
            ["annee_scolaire_id"=>1,"semestre_id"=>1,"classe_id"=>2,"actif"=>1],
            ["annee_scolaire_id"=>1,"semestre_id"=>1,"classe_id"=>3,"actif"=>1],
            ["annee_scolaire_id"=>1,"semestre_id"=>1,"classe_id"=>4,"actif"=>1],
        ];
        Param::insert($data);
    }
}
