<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandeMairieServiceHistorie extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="demande_mairie_service_histories";
    protected $fillable = [
        'demande_mairie_service_id',
        'administred_id',
        'register_user_id',
        'status',
    ];

}
