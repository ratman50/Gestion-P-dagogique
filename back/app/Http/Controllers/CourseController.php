<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Enseignant;
use App\Models\Module;
use App\Models\Semestre;
use Illuminate\Http\Client\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response([
            "data"=>[
                "professeur"=>Enseignant::all()->map(function($enseignant){
                    return [
                        "id"=>$enseignant->id,
                        "nom"=>$enseignant->prenom.' '.$enseignant->nom
                    ];
                }),
                "module"=>Module::all(),
                "classe"=>Classe::all(),
                "semestre"=>Semestre::all(),
                "cours"=> CourseResource::collection(Course::all())->paginate(6)
            ]
            ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $temp=[
            "semestre_id"=>$request->semestre["id"],
            "annee_scolaire_id"=>1,
            "classe_id"=>$request->classe["id"],
            "module_id"=>$request->module["id"],
            "heure_global"=>$request->heure_global,
            "professeur_id"=>$request->professeur["id"]
        ];
        Course::create($temp);
        $lastPage=ceil(Course::count()/6);

        return CourseResource::collection(Course::all())->paginate(6,"page",$lastPage);
    }

    /**
     * Display the specified resource.
     */
    public function show( $course)
    {
        $temp=explode('=',$course);
        return CourseResource::collection( Course::where($temp[0],$temp[1])->get());
    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, $course)
    {
        $cours=Course::find($course);
        return $request->semestre;
        $temp=[
            "semestre_id"=>$request->semestre["id"],
            "annee_scolaire_id"=>1,
            "classe_id"=>$request->classe["id"],
            "module_id"=>$request->module["id"],
            "heure_global"=>$request->heure_global,
            "professeur_id"=>$request->professeur["id"]
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
