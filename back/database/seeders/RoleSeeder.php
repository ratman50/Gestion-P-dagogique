<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=[
            ["libelle"=>"professeur"],
            ["libelle"=>"attache"],
            ["libelle"=>"etudiant"],
            ["libelle"=>"responsable pedagogique"]
        ];
        Role::insert($roles);
    }
}
