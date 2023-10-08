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
        $course_id = $this->data["course_id"];
        $classe_eff = Course::find($course_id)->param->classe;
        $salle_disp = Salle::where("places", ">=", $classe_eff->effectif)->get()->map(function ($classe) {
            return $classe->libelle;
        });
        if ($salle->places < $classe_eff->effectif)
            $fail("la salle {$value} est trop petite pour la classe {$classe_eff->libelle}! la  {$salle_disp[0]} peut l'accueillir");
        $date = Carbon::parse($this->data['date'])->format('Y-m-d');
        if(Session::occuped($this->data["heure_deb"], $this->data["heure_fin"], $date))
        $fail("la salle est déja reservée");
        // $count=$salle->sessions()->whereDate("date",$date)->count();
        // if($count)
        //     $fail("La salle est déjà réservée à cette date ");

    }
    public function getData()
    {
        return request()->validate();
    }
}
