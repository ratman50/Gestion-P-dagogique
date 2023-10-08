<?php

namespace Database\Seeders;

use App\Models\AnneeScolaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnneeScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[
            ["libelle"=>"2023-2024"],
            ["libelle"=>"2022-2023"],
            ["libelle"=>"2021-2022"],
            ["libelle"=>"2020-2021"],
            ["libelle"=>"2019-2020"],
            ["libelle"=>"2018-2019"],
            ["libelle"=>"2017-2018"],
        ];
        AnneeScolaire::insert($data);
    }
}
