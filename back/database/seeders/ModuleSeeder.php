<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules=[
            ["libelle"=>"Algo"],
            ["libelle"=>"Analayse de données"],
            ["libelle"=>"JavaScript"],
            ["libelle"=>"Php"],
            ["libelle"=>"Symfony"],
            ["libelle"=>"Java"],
            ["libelle"=>"Angular"],
            ["libelle"=>"React"],
            ["libelle"=>"Flutter"],
            ["libelle"=>"Ionic"],
            ["libelle"=>"Laravel"],
            ["libelle"=>"Python"],
            ["libelle"=>"Vue.js"],
            ["libelle"=>"Node.js"],
            ["libelle"=>"C"],
            ["libelle"=>"C++"],
            ["libelle"=>"Algo"],
            ["libelle"=>"React Native"],
            ["libelle"=>"Spring boot"],
            ["libelle"=>"Micro Service"],
            ["libelle"=>"Visual Basic"],
            ["libelle"=>"SQL"],
            ["libelle"=>"C#"],
            ["libelle"=>"Assembly language"],
            ["libelle"=>"Django"],
            ["libelle"=>"Ruby"],
            ["libelle"=>"JQuery"],
            ["libelle"=>"ASP.NET"],

        ];
        Module::insert($modules);
    }
}
