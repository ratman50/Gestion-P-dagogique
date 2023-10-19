<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Inscription;
use App\Models\Role;
use App\Models\User;
use App\Modules\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;

class UserController extends Controller
{
    public function __construct(private FileService $fileService)
    {
        
    }
    public function store(Request $request ){
        $validated = $request->validate([
            "content" => 'required',
            "name" => "required"
        ]);
        $file=$this->fileService->store($validated);
        $role_id=Role::where("libelle","etudiant")->first()->id;
        $classe_id=$request->query("classe");
        $annee_id=$request->query("annee");
        $fileName= "storage/".$file;
        $temp=[];
        return DB::transaction(function() use ($fileName,$annee_id,$role_id,$classe_id) {
            SimpleExcelReader::create($fileName)->getRows()->each(function($item) use($annee_id,$role_id,$classe_id) {
                $userExist=User::where("email",$item["email"])->first();
                $id="";
                if(!$userExist){
                    $id=User::create([
                        "nom"=>$item["nom"],
                        "email"=>$item["email"],
                        "role_id"=>$role_id,
                        "sexe"=>$item["sexe"],
                        "password"=>"12345"
                    ])->id;
                }
                else{
                    $id=$userExist->id;
                }
                $inscript=Inscription::where([
                    "classe_id"=>$classe_id,
                    "annee_scolaire_id"=>$annee_id,
                    "user_id"=>$id
                ])->first();
                if(!$inscript)
                {
                    Inscription::create([
                        "annee_scolaire_id"=>$annee_id,
                        "user_id"=>$id,
                        "classe_id"=>$classe_id,
                        "date_insciption"=>now()
                    ]);
                    $classe=Classe::find($classe_id);
                    $classe->effectif++;
                    $classe->save();
                }

        });
            });
        
        // return $rows;


        return $request;
    }
}
