<?php

namespace App\Models\User;


use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes,Feature;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email','phone', 'password','agent_id','administred_id','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class,'user_permission')->withTimestamps();
    }

    public function givePermissionsTo(Permission $permissions){
        return $this->permissions()->save($permissions);
    }

    public function hasPermission(Permission $permission){
        return $this->permissions()->get()->whereIn('id',$permission->id)->isNotEmpty();
    }
}
