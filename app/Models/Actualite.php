<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actualite extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="actualites";
    protected $fillable = [
        'appel',
        'resume',
        'description',
        'picture',
        'type_actualite_id',
        'mairie_id',
        'source',
        'source_link',
        'number_views',
        'register_user_id',
    ];

}
