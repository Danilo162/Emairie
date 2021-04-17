<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commerces extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function administred()
    {
        return $this->belongsTo("App\Models\Administred");
    }

    public function mairie()
    {
        return $this->belongsTo("App\Models\Mairies");
    }

}

