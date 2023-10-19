<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classe extends Model
{
    use HasFactory;
    protected $guarded=[];
   public function param():HasMany{
    return $this->hasMany(Param::class);

   }
   public function etudiants():BelongsToMany
   {
    return  $this->belongsToMany(User::class,"inscriptions");
   }
}
