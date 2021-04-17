<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeForfaitCommerceSeleted extends Model
{
    use SoftDeletes;
    protected $table = "taxeforfait_commerce_selecteds";
    protected $guarded = [];

}
