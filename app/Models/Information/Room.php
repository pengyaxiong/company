<?php

namespace App\Models\Information;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    protected $guarded = [];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
