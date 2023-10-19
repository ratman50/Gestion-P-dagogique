<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClasseRequest;
use App\Http\Requests\UpdateClasseRequest;
use App\Models\Classe;
use App\Models\Param;
use App\Models\User;
use App\Models\User_module;
use App\Traits\SessionFilterTrait;
use Illuminate\Http\Client\Request;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classe= Param::where("annee_scolaire_id",1)->get()->map(function($item){
            return $item->classe;
        });
        return response([
            "data"=>   $classe,
        ]);
        //
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
    public function store(StoreClasseRequest $request)
    {
        info("hellod");
        return response([
            "data"=>Classe::create($request->validated())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $classe)
    {
        //
    }

    
    public function info()
    {
        $temp=Classe::all()->map(function($item){
            $item["active"]=$item->param->map(function($info){
                return $info;
            })->count() ? true:false;
            $item["professeur"]=$item->param->map(function($info){
                $idModule=$info->courses->pluck("user_module");
                $idUser= User_module::whereIn("id",$idModule)->get("user_id");
                return User::whereIn("id",$idUser)->get();
                
            });
            $item["professeur"]=$item["professeur"]->first();
            
                unset($item["param"]);
            return$item;
        });
            //  $temp["course"]
        return response([
            "data"=>$temp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, Classe $classe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        //
    }
}
