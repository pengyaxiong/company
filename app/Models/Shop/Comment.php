<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //每个评论都属于某一个商品
    public function product()
    {
        return $this->belongsTo('App\Models\Shop\Product');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Shop\Customer');
    }
}
