<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Administred extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function mairie()
    {
        return $this->belongsTo("App\Models\Mairies");
    }

    public function commerces()
    {
        return $this->hasMany("App\Models\Commerces");
    }

}
