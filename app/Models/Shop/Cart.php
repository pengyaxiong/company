<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo('App\Models\Shop\Customer');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Shop\Product');
    }

    /**
     * 计算购物车总价和数量
     */
    static function count_cart($carts = null)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $count = [];

        //避免重复查询数据
        $carts = $carts ? $carts : Cart::with('product')->where('user_id', $user['id'])->get();

        $total_price = 0;
        $num = 0;
        foreach ($carts as $v) {
            $total_price += $v->product->price * $v->num;
            $num += $v->num;
        }

        $count['total_price'] = $total_price;
        $count['num'] = $num;

        return $count;
    }
}
