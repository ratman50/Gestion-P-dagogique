<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prof=User::where("role_id",1)->get("id");
        $data=[
            ["user_id"=>$prof[0]->id,"module_id"=>1,"heure_global"=>10,"param_id"=>1],
            ["user_id"=>$prof[0]->id,"module_id"=>2,"heure_global"=>20,"param_id"=>1],
            ["user_id"=>$prof[1]->id,"module_id"=>3,"heure_global"=>20,"param_id"=>2],
            ["user_id"=>$prof[2]->id,"module_id"=>4,"heure_global"=>20,"param_id"=>3],
            ["user_id"=>$prof[3]->id,"module_id"=>4,"heure_global"=>10,"param_id"=>4],
        ];
        Course::insert($data);
    }
}
