<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnseignantRequest;
use App\Http\Requests\UpdateEnseignantRequest;
use App\Http\Resources\EnseignantResource;
use App\Models\Enseignant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EnseignantResource::collection(User::byRole(1)->get());
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnseignantRequest $request)
    {
        $validated= $request->validated();
        return DB::transaction(function() use ($validated,$request){
            $temp=$request->only(["specialite","grade","email"]);
            $temp["nom"]=$validated["prenom"].' '.$validated["nom"];
            $temp["role_id"]=Role::where("libelle","professeur")->first()->id;
            $temp["password"]="12345";
            $user=User::create($temp);
            $user->modules()->attach($validated["module"]);
            return response([
                "data"=>$user
            ])  ;
        } );
    }

    /**
     * Display the specified resource.
     */
    public function show(Enseignant $enseignant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Enseignant $enseignant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnseignantRequest $request, Enseignant $enseignant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enseignant $enseignant)
    {
        //
    }
}
