<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enseignant>
 */
class EnseignantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tab=["dev web/mobile","AWS","referant digital","data analyst"];
        $grade=["chercheur","doctorant","master"];
        return [
            "nom"=>fake()->lastName(),
            "prenom"=>fake()->firstName(),
            "specialite"=>$tab[array_rand($tab)],
            'grade'=>$grade[array_rand($grade)]
        ];
        
    }
}
