<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function annee():BelongsTo{
        return $this->belongsTo(AnneeScolaire::class,"annee_scolaire_id");
    }
     public function semestre():BelongsTo{
        return $this->belongsTo(Semestre::class);
    } 
    public function module():BelongsTo{
        return $this->belongsTo(Module::class);
    }
    public function professeur():BelongsTo{
        return $this->belongsTo(Enseignant::class,"enseignant_id");
    }
    public function classe():BelongsTo{
        return $this->belongsTo(Classe::class);
    }
    
}
