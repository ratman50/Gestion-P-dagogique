<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUser implements ToModel
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            return new User([
            'nom'=>$row[0],
            'email'=>$row[1],
            "sexe"=>$row[2],
            // "password"=>"12345",
            // "role_id"=>3
        ]);
    }
    // public function collection(Collection $collection)
    // {
    //     dd($collection);
    // }
}
