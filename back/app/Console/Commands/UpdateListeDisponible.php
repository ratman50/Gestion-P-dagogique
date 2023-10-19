<?php

namespace App\Console\Commands;

use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateListeDisponible extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-liste-disponible';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now()->subMinutes(3);
    
        $tempsLimite=explode(':',$date->format("H:i"));
        $hour=$tempsLimite[0]+ ($tempsLimite[1]/60);
        Session::whereDate("date",$date)->where(function($q) use($hour) {
            $q->where("liste_disponible",false)
            ->where("heure_deb",$hour);
        })->update(["liste_disponible"=>true]);
        

    }
}
