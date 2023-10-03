<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Enseignant;
use App\Models\Module;
use App\Models\Semestre;

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
            ]
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        return Course::create($temp);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
