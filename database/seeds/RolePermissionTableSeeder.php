<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolePermissions = [
        ["role_id"=>1,"permission_id"=>1],
        ["role_id"=>1,"permission_id"=>2],
        ["role_id"=>1,"permission_id"=>3],
        ["role_id"=>1,"permission_id"=>4],
        ["role_id"=>1,"permission_id"=>6],
        ["role_id"=>1,"permission_id"=>9],
        ["role_id"=>1,"permission_id"=>10],
        ["role_id"=>1,"permission_id"=>13],

        ["role_id"=>2,"permission_id"=>1],
        ["role_id"=>2,"permission_id"=>2],
        ["role_id"=>2,"permission_id"=>3],
        ["role_id"=>2,"permission_id"=>5],
        ["role_id"=>2,"permission_id"=>10],
        ["role_id"=>2,"permission_id"=>6],
        ["role_id"=>4,"permission_id"=>6],

        ];
        DB::table('role_permission')->truncate();
        foreach ($rolePermissions as $role_permission){
            DB::table('role_permission')->insert($role_permission);
        }
    }
}
