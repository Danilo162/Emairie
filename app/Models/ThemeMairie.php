<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThemeMairie extends Model
{

    use SoftDeletes;
    protected $table = "theme_mairies";
    protected $fillable = ["theme","mairie_id"];
}
