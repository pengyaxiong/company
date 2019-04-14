<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //黑名单为空
    protected $guarded = ['image'];


    public function photo()
    {
        return $this->belongsTo('App\Models\System\Photo');
    }

    //一个品牌有多个商品
    public function products()
    {
        return $this->hasMany('App\Models\Shop\Product');
    }

    /**
     * 检查当前品牌是否有商品
     */
    static function check_products($id)
    {
        $brand = self::with('products')->find($id);
        if ($brand->products->isEmpty()) {
            return true;
        }
        return false;
    }
}
