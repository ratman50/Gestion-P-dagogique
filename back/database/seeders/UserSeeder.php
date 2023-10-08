<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function createUsers(int $nombre,int $role)
    {
        $result=[];
        for ($i=0; $i < $nombre; $i++) { 
            $result[]=$this->createAnUser($role);
        }
        return $result;
    }
    public function createAnUser(int $role){
        return [
            'nom' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '12345', // password
            'remember_token' => Str::random(10),
            "role_id"=>$role
        ];
    }
    public function run(): void
    {
        //
        $user=[
            ...$this->createUsers(8,1),
            ...$this->createUsers(1,2),
            ...$this->createUsers(100,3),
            ...$this->createUsers(1,4)
        ];
        // $user[]=$this->createUsers(8,1);//professeur
        // $user[]=$this->createUsers(1,2);//attache
        // $user[]=$this->createUsers(100,3);//etudiant
        // $user[]=$this->createUsers(1,4);//RP
        foreach ($user as $key => $value) {
            # code...
            User::create($value);
        }

    }
}
