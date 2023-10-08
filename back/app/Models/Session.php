<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function  scopeOccuped(Builder $query,int $deb,int $fin, $date){
        return $query->whereDate("date",$date)
        ->where(function($q) use($deb,$fin){
            $q->whereBetween("heure_deb",[$deb,$fin])
            ->orWhereBetween("heure_fin",[$deb,$fin]);

        })
        ->exists()
        ;
    }
}
