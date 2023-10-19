<?php

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Enseignant;
use App\Models\Module;
use App\Models\Param;
use App\Models\Professeur;
use App\Models\Semestre;
use App\Models\User;
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
            $table->integer("heure_global")->constrained();
            $table->boolean("terminer")->default(false);
            $table->integer("heure_restant");
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
