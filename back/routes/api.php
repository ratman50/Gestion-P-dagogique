<?php

use App\Http\Controllers\AnneeScolaireController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NiveauController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("/login",[AuthController::class,"login"]);
Route::group(["middleware"=>["auth:sanctum"]],function(){

    Route::get("session/info",[SessionController::class,"info"]);
    Route::get("session/liste/{id}",[SessionController::class,"list"]);
    Route::get("classe/info",[ClasseController::class,"info"]);
    Route::post("session/absent",[SessionController::class,"absence"]);
    Route::apiResources([
        "cours"=>CourseController::class,
        "enseign"=>EnseignantController::class,
        "salle"=>SalleController::class,
        "classe"=>ClasseController::class,
        "module"=>ModuleController::class,
        "session"=>SessionController::class,
        "enseignant"=>EnseignantController::class,
        "niveau"=>NiveauController::class,
        "user"=>UserController::class,
        "annee"=>AnneeScolaireController::class
    
    ]);
});