<?php

namespace App\Traits;

use App\Models\Course;
use App\Models\Param;
use App\Models\Session;
use App\Models\User_module;
use Carbon\Carbon;

trait SessionFilterTrait
{
    public function getSessions(string $name, string $value, int $year, int $week, int $renvoyer = 0)
    {
        $session = null;

        if ($name == 'salle_id') {
            $session = Session::where("salle_id", $value);
        }
        if ($name == "classe_id") {
            $idParam = Param::where("classe_id", $value)->get()->pluck("id");
            $idCourse = Course::whereIn("param_id", $idParam)->get()->pluck("id");
            $session = Session::whereIn("course_id", $idCourse);
        }
        if ($name == "module_id") {
            $idUser_module = User_module::where("module_id", $value)->get()->pluck("id");
            $idCourse = Course::whereIn("user_module", $idUser_module)->get()->pluck("id");
            $session = Session::whereIn("course_id", $idCourse);
        }
        if ($name == "enseignant_id") {
            $idUser_module = User_module::where("user_id", $value)->get()->pluck("id");
            $idCourse = Course::whereIn("user_module", $idUser_module)->get()->pluck("id");
            $session = Session::whereIn("course_id", $idCourse);
        }
        $startOfWeek = Carbon::createFromFormat('Y-m-d', $year . '-01-01')
            ->startOfWeek()
            ->addWeeks($week);
        $endOfWeek = $startOfWeek->copy()->endOfWeek();
        return $session
            ->where("renvoyer", $renvoyer)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get();
    }
}
