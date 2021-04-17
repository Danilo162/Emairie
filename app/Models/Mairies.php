<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mairies extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function administreds()
    {
        return $this->hasMany("App\Models\Administred");
    }

    public function commerces()
    {
        return $this->hasMany("App\Models\Commerces");
    }

}
