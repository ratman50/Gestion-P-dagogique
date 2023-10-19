<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Session extends Model
{
    use HasFactory;
    protected $guarded=[];

   
    public function scopeOccuped(Builder $query, $deb, $fin, $date){

        return $query->whereDate("date", $date)  
                     ->where(function($q) use ($deb, $fin) {
      
                       $q->where(function($q2) use ($deb, $fin) {
      
                         $q2->where("heure_deb", ">", $deb)
                           ->where("heure_deb", "<", $fin)
      
                           ->orWhere("heure_fin", ">", $deb)  
                           ->where("heure_fin", "<", $fin);
      
                       })
                       ->orWhere(function($q2) use ($deb, $fin) {
      
                         $q2->where("heure_deb", "<", $fin)   
                           ->where("heure_fin", ">", $deb);
      
                       });
      
                     })
                     ->exists();
      
      }
    public function course():BelongsTo{
        return $this->belongsTo(Course::class);
    }
    public function salle():BelongsTo{
        return $this->belongsTo(Salle::class);
    }
    public function scopeUniqueColor($query){
        $colors=$query->pluck("color")->toArray();
        do {
            $color = $this->generateRandomColor();
        } while (in_array($color, $colors));
        return $color;
    }
    public function generateRandomColor() {

        $red = mt_rand(200, 255);
        $green = mt_rand(200, 255);
        $blue = mt_rand(200, 255);
      
        return '#' .
            str_pad(dechex($red), 2, '0', STR_PAD_LEFT).  
            str_pad(dechex($green), 2, '0', STR_PAD_LEFT).
            str_pad(dechex($blue), 2, '0', STR_PAD_LEFT);
      
      }
    public function absents():BelongsToMany{
      return $this->belongsToMany(User::class,"absences");
    }
}
