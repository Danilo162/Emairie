<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Status 0 : visible seulement pour administrateur systeme
     * Status 1 : visible pour autre administrateur
     * @return void
     */
    public function run()
    {

        $permissions = [
        ["id"=>1,"name"=>"Listing Paramètres","comment"=>'Liste des paramètres',"status"=>1],
        ["id"=>2,"name"=>"Listing Roles","comment"=>'Liste des rôles',"status"=>1],
        ["id"=>3,"name"=>"Listing Agents","comment"=>'Liste des agents',"status"=>1],
        ["id"=>4,"name"=>"Listing Mairies","comment"=>'Liste des mairies',"status"=>0],
        ["id"=>5,"name"=>"Listing Administrés","comment"=>'Liste des administrés',"status"=>1],
        ["id"=>6,"name"=>"Listing Commerces","comment"=>'Liste des administrés',"status"=>1],
        ["id"=>7,"name"=>"Ajouter,Modifier Permission","comment"=>'Ajouter, modifier une permission',"status"=>0],
        ["id"=>8,"name"=>"Supprimer Permission","comment"=>' supprimer une permission',"status"=>0],
        ["id"=>9,"name"=>"Permissions Assign","comment"=>'Attribuer une permission à un rôle',"status"=>1],
        ["id"=>10,"name"=>"Delegate Permission","comment"=>'Déléguer une permission à un agent',"status"=>1],
        ["id"=>11,"name"=>"Ajouter, Modifier Roles ","comment"=>'Ajouter, modifier un rôle ',"status"=>1],
        ["id"=>12,"name"=>"Supprimer Roles ","comment"=>' supprimer un rôle ',"status"=>1],
        ["id"=>13,"name"=>"Listing paiements","comment"=>'Methode paiement',"status"=>0],
        ];
        Permission::query()->truncate();
        foreach ($permissions as $permission){
            Permission::create($permission);
        }
    }
}
