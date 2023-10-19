<?php

namespace App\Rules;

use App\Models\Course;
use App\Models\Salle;
use App\Models\Session;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Symfony\Component\Console\Input\Input;

class SalleRule implements ValidationRule, DataAwareRule
{
    /**
     * All of the data under validation.
     *
     * @var array<string, mixed>
     */
    protected $data = [];

    /**
     * Set the data under validation.
     *
     * @param  array<string, mixed>  $data
     */
    public function setData(array $data): static
    {
        $this->data = $data;

        return $this;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $salle = Salle::find($value);
        $this->data["date"] = Carbon::parse($this->data['date'])->format('Y-m-d');
        $course_id = $this->data["course_id"];
        $selectedKey = ["heure_deb", "heure_fin", "salle_id", "date"];
        $filteredData = array_intersect_key($this->data, array_flip($selectedKey));
        $copyFiltered = array_intersect_key($this->data, array_flip([...$selectedKey, "course_id"]));
        if (Session::where($copyFiltered)->exists())
            $fail("deja enregistree");
        $salle = Salle::find($this->data["salle_id"]);
        $courseModele = Course::find($course_id);
        $idCourseProgramme = Session::where($filteredData)->get(["course_id", "salle_id"]);
        if (count($idCourseProgramme)) {
            // dd($idCourseProgramme->pluck("course_id"));
            if (Course::whereIn("user_module", $idCourseProgramme->pluck("course_id"))->count() <= 1)
                $fail("deux modules différents ne peuvent pas se faire sur une meme salle à la meme heure");
            $temp = Course::where("user_module", $courseModele->user_module)->get();

            if ($temp) {
                $course_id_planifier = Session::whereIn(
                    "course_id",
                    $temp->pluck("id")
                )->get();
                $totalEff = $course_id_planifier->reduce(function ($carry, $session) {
                    $carry += $session->course->param->classe->effectif;
                    return $carry;
                }, 0);
                $totalEff += $courseModele->param->classe->effectif;
                $classes = $course_id_planifier->map(function ($session) {
                    return $session->course->param->classe->libelle;
                });
                if ($totalEff > $salle->places) {
                    $classes[] = $courseModele->param->classe->libelle;
                    $acc = join(',', [...$classes]);
                    $fail("{$salle->libelle} est trop petite pour les classes {$acc}");
                }
            }
        } else {

            $classe_eff = $courseModele->param->classe;
            $salle_disp = Salle::where("places", ">=", $classe_eff->effectif)->get()->map(function ($item) {
                return $item->libelle;
            });
            if ($salle->places < $classe_eff->effectif)
                $fail("la salle {$value} est trop petite pour la classe {$classe_eff->libelle}! la  {$salle_disp[0]} peut l'accueillir");

            if (Session::occuped($this->data["heure_deb"], $this->data["heure_fin"], $this->data["date"]))
                $fail("la salle est déja reservée");
        }
    }
    public function getData()
    {
        return request()->validate();
    }
}
