<?php

namespace App\Http\Resources;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
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
            "salle"=>$this->salle,
            "date"=>$this->date,
            "cours_id"=>$this->course_id,
            "color"=>$this->color,
            "valider"=>$this->valider,
            "heure_deb"=>$this->heure_deb,
            "heure_fin"=>$this->heure_fin,
            "course"=>new CourseResource(Course::find($this->course_id))
        ];
    }
}
