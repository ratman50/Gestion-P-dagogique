<?php

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Module;
use App\Models\Professeur;
use App\Models\Semestre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Classe::class);
            $table->foreignIdFor(AnneeScolaire::class);
            $table->foreignIdFor(Professeur::class);
            $table->foreignIdFor(Semestre::class);
            $table->foreignIdFor(Module::class);
            $table->integer("heure_global");
            $table->unique(["classe_id","annee_scolaire_id"]);
            $table->unique([            "professeur_id","semestre_id","module_id"
            ])
            ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
