<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * 商品管理首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index()
    {
        return view('admin.shop.mobile');
    }
}
