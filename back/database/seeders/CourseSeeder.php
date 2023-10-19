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
            ["user_module"=>1,"heure_global"=>10,"param_id"=>1,"heure_restant"=>10],
            ["user_module"=>1,"heure_global"=>10,"param_id"=>2,"heure_restant"=>10],
            ["user_module"=>2,"heure_global"=>20,"param_id"=>1,"heure_restant"=>20],
            ["user_module"=>3,"heure_global"=>20,"param_id"=>2,"heure_restant"=>20],
            ["user_module"=>4,"heure_global"=>20,"param_id"=>3,"heure_restant"=>20],
            ["user_module"=>4,"heure_global"=>10,"param_id"=>4,"heure_restant"=>10],
        ];
        Course::insert($data);
    }
}
