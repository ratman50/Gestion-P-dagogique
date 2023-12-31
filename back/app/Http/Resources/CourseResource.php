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
            "annee"=>$this->param->annee,
            "semestre"=>$this->param->semestre,
            "classe"=>$this->param->classe,
            "module"=>$this->userModule->module,
            "professeur"=>$this->userModule->professeur,
            "heure_global"=>$this->heure_global
        ];
    }
}
