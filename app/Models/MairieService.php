<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MairieService extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table="mairie_services";
    protected $fillable = [
        'service_id',
        'mairie_id',
        'register_user_id',
    ];

}
