<?php

use App\Models\Course;
use App\Models\Salle;
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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class)->constrained();
            $table->date("date");
            $table->foreignIdFor(Salle::class)->constrained();
            $table->integer("heure_deb");
            $table->integer("heure_fin");
            $table->boolean("valider")->default(false);
            $table->boolean("renvoyer")->default(false);
            $table->unique(["course_id","date","heure_deb","heure_fin","valider","renvoyer"],"unique_line");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
