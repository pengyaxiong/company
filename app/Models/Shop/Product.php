<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = ['category_id','imgs','image', 'file'];


    public function photo()
    {
        return $this->belongsTo('App\Models\Photo');
    }
    //每个商品都属于某一个品牌
    public function brand()
    {
        return $this->belongsTo('App\Models\Shop\Brand');
    }

    //商品可以属于多个分类
    public function categories()
    {
        return $this->belongsToMany('App\Models\Shop\Category');
    }

    //一个商品有很多相册图片
    public function product_galleries()
    {
        return $this->hasMany('App\Models\Shop\ProductGallery');
    }

    //一个商品有很多评论
    public function comments()
    {
        return $this->hasMany('App\Models\Shop\Comment');
    }

    public function order_products()
    {
        return $this->hasMany('App\Models\Shop\OrderProduct');
    }

    //检查当前商品是否有订单
    static function check_orders($id)
    {
        $product = self::with('order_products')->find($id);
        if ($product->order_products->isEmpty()) {
            return true;
        }
        return false;
    }
}
