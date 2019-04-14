<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['openid', 'nickname', 'sex', 'language', 'city', 'province', 'country', 'headimgurl', 'email'];

    //一个用户有很多评论
    public function comments()
    {
        return $this->hasMany('App\Models\Shop\Comment');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Shop\Order');
    }
}
