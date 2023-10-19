<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AnneeScolaire;
use App\Models\Inscription;
use App\Models\Niveau;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            RoleSeeder::class,
            NiveauSeeder::class,
            ClasseSeeder::class,
            SemestreSeeder::class,
            AnneeScolaireSeeder::class,
            ModuleSeeder::class,
            SalleSeeder::class,
            UserSeeder::class,
            ModuleEnseignesSeesder::class,
            ParamSeeder::class,
            CourseSeeder::class,
            InscriptionSeeder::class
        ]);
    }
}
