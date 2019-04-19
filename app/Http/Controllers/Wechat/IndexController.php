<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ads\Ad;
use App\Models\Shop\Product;

class IndexController extends Controller
{
    public function __construct()
    {
        view()->share('_index', 'on');
    }

    /**
     * 商城首页
     */
    public function index()
    {
        //首页焦点图
        $slides = Ad::with('photo')->where('category_id', 1)->orderBy('sort_order')->get();
//        return $slides;
        //首页banner图
        $banners = Ad::with('photo')->where('category_id', 2)->orderBy('sort_order')->get();

        //商品列表
        $products = Product::with('photo')->where('is_recommend', true)->orderBy('is_onsale', 'desc')->orderBy('sort_order')->get();
        return view('wechat.index', compact('slides', 'banners', 'products'));
    }




}
