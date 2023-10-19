<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Http\Resources\EnseignantResource;
use App\Http\Resources\SessionResource;
use App\Imports\ImportUser;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Module;
use App\Models\Param;
use App\Models\Salle;
use App\Models\Session;
use App\Models\User;
use App\Modules\CourseService;
use App\Modules\FileService;
use App\Modules\SessionService;
use App\Traits\SessionFilterTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\SimpleExcel\SimpleExcelReader;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Symfony\Component\HttpFoundation\Response;

class SessionController extends Controller
{
    use SessionFilterTrait;
    public function __construct(
        private CourseService $courseService,
        private SessionService $sessionService,
        private FileService $fileService
    ) {
    }
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function info()
    {
        $temp = User::byRole(1);

        return response(
            ["data" => [
                "salle" => Salle::all(),
                "enseignant" => EnseignantResource::collection($temp->get()),
                "total" => [
                    "enseignant" => $temp->count(),
                    "salle" => Salle::all()->count(),
                    "module" => Module::all()->count(),
                    "classe" => Classe::all()->count()
                ]
            ]]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSessionRequest $request)
    {
        $data = $request->validated();
        $duree = $request["heure_fin"] - $request["heure_deb"];
        $this->courseService->updateHeure_restante($duree, $request["course_id"]);
        return
            response([
                "data" =>
                $this->courseService->planningDay(new SessionResource(Session::create($this->sessionService->handleAddSession($data))))
            ]);
    }
    /**
     * Display the specified resource.
     */
    public function show($param)
    {
        $accept = [
            "salle_id",
            "enseignant_id",
            "classe_id",
            "module_id"
        ];
        $session = null;
        $temp = explode("=", $param);

        if (!in_array($temp[0], $accept));
        return response(["message" => "le filtre {$temp[0]} est incorrecte}"], Response::HTTP_BAD_REQUEST);
        // return SessionResource::collection($this->getSessions($temp[0], $temp[1]));
    }

    public function list(Request $request, $idSession)
    {
        $session = Session::findOrfail($idSession);
        $data = [];
        if ($session->liste_disponible) {
            $course = Course::find($session->course_id);
            $data = Classe::find($course->param->classe_id)->etudiants;
        }
        return response(["data" => $data]);
    }
    public function absence(Request $request)
    {
        $validated = $request->validate([
            "id" => "required|exists:sessions,id",
            "etudiant" => "required|array",
            "etudiant.*" => "exists:users,id"
        ]);
        $session=Session::find($validated["id"]);
        $session->absents()->attach($validated["etudiant"]);
        return $session;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSessionRequest $request, Session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        //
    }
}
