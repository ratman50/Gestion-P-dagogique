<?php

namespace Database\Seeders;

use App\Models\Semestre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ["libelle"=>"semestre 1"]
            ,["libelle"=>"semestre 2"]
            ,["libelle"=>"trimestre 1"]
            ,["libelle"=>"trimestre 2"]
            ,["libelle"=>"trimestre 3"]
        ];
        Semestre::insert($data);
    }
}
