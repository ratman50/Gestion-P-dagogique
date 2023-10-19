<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Inscription;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where("libelle", "etudiant")->first()->id;

        $etudiants = User::byRole($role)->get();
        // print_r($etudiants);
        $chunks = array_chunk($etudiants->toArray(), 25);
        foreach ($chunks as $key => $value) {
            $ids =array_map(function ($item) use ($key) {
                return [
                    "user_id" => $item["id"],
                    "classe_id" => $key+1 ,
                    "annee_scolaire_id" => 1,
                    "date_inscription"=>now()
                ];
            }, $value);
            Inscription::insert($ids);
            $classe=Classe::find($key+1);
            $classe->effectif+=count($value);
            $classe->save();
        }
        
    }
}
