<?php
namespace App\Modules;

use App\Http\Resources\SessionResource;
use App\Models\Course;
use Carbon\Carbon;

class CourseService
{
    public function updateHeure_restante(int $duree, int $course_id){
        $courseModel=Course::find($course_id);
        $courseModel->heure_restant-=$duree;
        if($courseModel->heure_restant==0)
            $courseModel->terminer=1;
        $courseModel->save();
    }

    public function planning($data){
        // $datePlanning="2023-10-11";
        $result=[];
        $days=["lundi","mardi","mercredi","jeudi","vendredi","samedi"];
        foreach ($days as  $key=> $day) {
            $jour=[
                "index"=>$key,
                "jour"=>$day,
            ];
            $sessionFiltered=$data->filter(function($session) use ($key){
                $dayCheck=Carbon::parse($session->date)->dayOfWeek-1; 
               
                return $dayCheck==$key;
            });
            $jour["session"]=[... $sessionFiltered];
            $result[]=$jour;
        }
        return $result;
        // return $data;
    }
    public function planningDay($session){
        $days=["lundi","mardi","mercredi","jeudi","vendredi","samedi"];
        foreach ($days as $key => $day) {
            # code...
            $dayCheck=Carbon::parse($session->date)->dayOfWeek-1;
            if($dayCheck==$key){
                return [
                    "index"=>$key,
                    "jour"=>$day,
                    "session"=>$session
                ];
            }
        }
    }
}