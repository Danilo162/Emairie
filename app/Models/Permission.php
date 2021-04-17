<?php

namespace App\Models;


use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
 use SoftDeletes;

 protected $fillable = ['name','comment','status'];

 public function roles(){
     return $this->belongsToMany(Role::class,'role_permission');
 }

 public function users(){
     return $this->belongsToMany(User::class,'user_permission');
 }
}
