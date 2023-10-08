<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Param extends Model
{
    use HasFactory;
    public function annee():BelongsTo{
        return $this->belongsTo(AnneeScolaire::class,"annee_scolaire_id");
    }
     public function semestre():BelongsTo{
        return $this->belongsTo(Semestre::class);
    } 
    public function classe():BelongsTo{
        return $this->belongsTo(Classe::class);
    }

}
