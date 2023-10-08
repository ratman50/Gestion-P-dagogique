<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleEnseignesSeesder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profs = User::where("role_id", 1)->get();
        $modules = Module::pluck("id")->all();


        foreach ($profs as $prof) {

            $moduleIds = array_slice($modules, 0, 3);

            $assignedModules = [];

            foreach ($moduleIds as $moduleId) {

                $assignedModules[] = [
                    "user_id" => $prof->id,
                    "module_id" => $moduleId
                ];

                $modules = array_diff($modules, [$moduleId]);
            }

            DB::table("user_modules")->insert($assignedModules);
        }
    }
}
