<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ["id"=>1,"name"=>"Administrateur Système","comment"=>'Administrateur système'],
            ["id"=>2,"name"=>"Administrateur Fonctionnel","comment"=>'Administrateur de la mairie'],
            ["id"=>3,"name"=>"Agent Percepteur","comment"=>'Agent percepteur pour la collecte des taxes'],
            ["id"=>4,"name"=>"Agent","comment"=>'Agent de la mairie'],
            ["id"=>5,"name"=>"Administred","comment"=>'Administrés'],

        ];
        Role::query()->truncate();
        foreach ($roles as $role){
            Role::create($role);
        }
    }
}
