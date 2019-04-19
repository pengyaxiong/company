<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Shop\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    function __construct()
    {
        view()->share([
            '_customer' => 'on',
        ]);
    }


    /** 会员中心
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $user=session('wechat.oauth_user.default');
//        $original = $user->original;
//        $img=$original['headimgurl'];
//        $arr = parse_url($img);
//        $original['headimgurl']=$arr['path'];
        $original['nickname']='grubby';
        $original['headimgurl']='grubby';
        $order_a=Order::where(['customer_id'=>session('wechat.customer.id')])->count();
        $order_1=Order::where(['customer_id'=>session('wechat.customer.id'),'status'=>1])->count();
        $order_2=Order::where(['customer_id'=>session('wechat.customer.id'),'status'=>2])->count();
        return view('wechat.customer.index', compact('original','order_a','order_1','order_2'));
    }
}
