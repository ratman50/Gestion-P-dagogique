<?php
namespace App\Modules;

use App\Models\Session;
use Carbon\Carbon;

class SessionService{

    public function  handleAddSession($data){
        $data['date'] = Carbon::parse($data['date'])->format('Y-m-d');
        $data["color"]=Session::uniqueColor();
        return $data;
    }
    
}