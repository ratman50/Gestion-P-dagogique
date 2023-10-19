<?php
namespace App\Modules;

use Illuminate\Support\Facades\Storage;

class FileService{
 
    public function store($validated){
        $exelData = base64_decode(
            str_replace(
                'data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,',
                "",
                $validated["content"]
            )
        );
        $filename = $validated["name"];
        Storage::put("public/".$filename, $exelData);
        return $filename;
    }
}
