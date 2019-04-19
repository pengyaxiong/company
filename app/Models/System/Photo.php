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

    public function ad()
    {
        return $this->hasMany('App\Models\Ads\Ad');
    }

    public function article()
    {
        return $this->hasMany('App\Models\Cms\Article');
    }

    public function brand()
    {
        return $this->hasMany('App\Models\Shop\Brand');
    }

    public function category()
    {
        return $this->hasMany('App\Models\Shop\Category');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Shop\Product');
    }
}