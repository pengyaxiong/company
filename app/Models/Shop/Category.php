<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Cache,DB;

class Category extends Model
{
    //黑名单为空
    protected $guarded = ['image'];
    protected $table = 'product_categories';

    public function photo()
    {
        return $this->belongsTo('App\Models\System\Photo');
    }


    public function children()
    {
        return $this->hasMany('App\Models\Shop\Category', 'parent_id', 'id');
    }


    //一个分类有多个商品
    public function products()
    {
        return $this->belongsToMany('App\Models\Shop\Product');
    }


    //清除缓存
    static function clear()
    {
        Cache::forget('shop_categories');
    }

    /**
     * 生成分类数据
     * @return mixed
     */
    static function get_categories()
    {
        $categories = Cache::rememberForever('shop_categories', function () {
            return self::with('photo')
                ->with([
                    'children' => function ($query) {
                        $query->with('photo');
                        $query->orderBy('sort_order')->orderBy('id');
                    }
                ])->where('parent_id', 0)->orderBy('sort_order')->orderBy('id')->get();
        });

        return $categories;
    }

    /**
     * 筛选分类时,屏蔽掉没有商品的分类
     */
    static function filter_categories()
    {
        $categories = self::has('children.products')->with([
            'children' => function ($query) {
                $query->has('products');
            }
        ])->get();
        return $categories;
    }

    /**
     * 检查是否有子栏目
     */
    static function check_children($id)
    {
        $category = self::with('children')->find($id);
        if ($category->children->isEmpty()) {
            return true;
        }
        return false;
    }

    /**
     * 检查当前分类是否有商品
     */
    static function check_products($id)
    {
        $category = self::with('products')->find($id);
        if ($category->products->isEmpty()) {
            return true;
        }
        return false;
    }
}
