<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Http\Resources\EnseignantResource;
use App\Http\Resources\PlanningResource;
use App\Http\Resources\SessionResource;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Module;
use App\Models\Param;
use App\Models\Semestre;
use App\Models\Session;
use App\Models\User;
use App\Models\User_module;
use App\Modules\CourseService;
use App\Traits\SessionFilterTrait;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    use SessionFilterTrait;

    public function __construct(private CourseService $courseService)
    {
    }
    /**
     * Display a listing of the resource.
     * 
     */

    public function index()
    {
        return response([
            "data" => [
                "professeur" => EnseignantResource::collection(User::byRole(1)->get()),
                "module" => Module::all(),
                "classe" => Classe::all(),
                "semestre" => Semestre::all(),
                "cours" => CourseResource::collection(Course::all())->paginate(6)
            ]
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $temp = [
            "semestre_id" => $request->semestre["id"],
            "annee_scolaire_id" => 1,
            "classe_id" => $request->classe["id"],
            "module_id" => $request->module["id"],
            "heure_global" => $request->heure_global,
            "professeur_id" => $request->professeur["id"]
        ];
        Course::create($temp);
        $lastPage = ceil(Course::count() / 6);

        return CourseResource::collection(Course::all())->paginate(6, "page", $lastPage);
    }

    /**
     * Display the specified resource.
     */
    public function show($course)
    {

        $tempo = explode('&', $course);
        $temp = explode("=", $tempo[0]);
        $date = explode("=", $tempo[1]);
        $semaineTemp = explode('-', $date[1]);
        $year = $semaineTemp[0];
        $week = substr($semaineTemp[1], 1);
        $accept = [
            "salle_id",
            "enseignant_id",
            "classe_id",
            "module_id"
        ];
        if (!in_array($temp[0], $accept))
            return response(["message" => "le filtre {$temp[0]} est incorrecte}"], Response::HTTP_BAD_REQUEST);

        $course;
        if ($temp[0] === "classe_id") {
            $idParam = Param::where(["classe_id" => $temp[1], "actif" => 1])->get()->pluck('id');
            $course = Course::whereIn("param_id", $idParam)->get();
        }
        if ($temp[0] == "enseignant_id" || $temp[0] == "module_id") {
            $temp_id = null;
            if ($temp[0] == "enseignant_id") {

                $user = User::find($temp[1]);
                $temp_id = $user->modules->pluck("pivot.id");
            } else {

                $temp_id = User_module::where("module_id", $temp[1])->get()->pluck("id");
            }
            $course = Course::whereIn("user_module", $temp_id)->get();
        }

        if ($temp[0] == "salle_id") {
            return $this->courseService->planning(
                SessionResource::collection($this->getSessions($temp[0], $temp[1], $year, $week))
            );
        }
        return response([
            "data" => [
                "course" => CourseResource::collection($course),
                "sessions" => $this->courseService->planning(
                    SessionResource::collection($this->getSessions($temp[0], $temp[1],$year,$week))
                )
            ]
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, $course)
    {
        $cours = Course::find($course);
        return $request->semestre;
        $temp = [
            "semestre_id" => $request->semestre["id"],
            "annee_scolaire_id" => 1,
            "classe_id" => $request->classe["id"],
            "module_id" => $request->module["id"],
            "heure_global" => $request->heure_global,
            "professeur_id" => $request->professeur["id"]
        ];
        $cours->update($temp);
        return $cours;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
