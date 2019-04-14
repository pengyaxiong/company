<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //白名单
    protected $fillable = ['identifier'];


    public function getThumbAttribute()
    {
        if ($this->link) {
            return $this->link . '-thumb';
        }
    }

    public function article()
    {
        return $this->hasMany('App\Models\Cms\Article');
    }
}