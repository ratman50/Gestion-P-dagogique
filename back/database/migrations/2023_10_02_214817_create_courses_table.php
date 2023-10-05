<?php

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Enseignant;
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
            $table->foreignIdFor(Classe::class)->constrained();
            $table->foreignIdFor(AnneeScolaire::class)->constrained();
            $table->foreignIdFor(Enseignant::class)->constrained();
            $table->foreignIdFor(Semestre::class)->constrained();
            $table->foreignIdFor(Module::class)->constrained();
            $table->integer("heure_global")->constrained();
            $table->unique(["classe_id","annee_scolaire_id","enseignant_id","semestre_id","module_id"],'courses_unique_index');
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
