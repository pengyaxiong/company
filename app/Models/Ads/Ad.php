<?php

namespace App\Models\Ads;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ad extends Model
{

    protected $guarded = ['image'];
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function category()
    {
        return $this->belongsTo('App\Models\Ads\Category');
    }

    public function photo()
    {
        return $this->belongsTo('App\Models\System\Photo');
    }
}
