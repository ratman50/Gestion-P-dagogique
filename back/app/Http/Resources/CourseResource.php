<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "annee"=>$this->annee,
            "semestre"=>$this->semestre,
            "classe"=>$this->classe,
            "module"=>$this->module,
            "professeur"=>$this->professeur,
            "heure_global"=>$this->heure_global
        ];
    }
}