<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name','comment','mairie_id'
    ];
    public function permissions(){
        return $this->belongsToMany(Permission::class,'role_permission')->withTimestamps();
    }

    public function givePermissionsTo(Permission $permissions){
        return $this->permissions()->save($permissions);
    }

    public function hasPermission(Permission $permission){
        return $this->permissions()->get()->whereIn('id',$permission->id)->isNotEmpty();
    }
}
