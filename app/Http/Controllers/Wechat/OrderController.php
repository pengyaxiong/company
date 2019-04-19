<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Shop\OrderAddress;
use App\Models\Shop\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Cart;
use App\Models\Shop\Address;
use App\Models\Shop\Order;
use App\Handlers\WechatConfigHandler;

class OrderController extends Controller
{
    protected $wechat;

    public function __construct(WechatConfigHandler $wechat)
    {
        $this->wechat = $wechat;
    }

    /**
     * 订单列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function index(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {
            $query->where('customer_id', session('wechat.customer.id'));

            switch ($request->status) {
                case '':
                    break;
                case '1':
                    $query->where('status', 1);
                    break;
                case '2':
                    $query->whereIn('status', [2, 3, 4]);
                    break;
            }
        };

        $order_status = config('admin.order_status');
        $orders = Order::where($where)->with('order_products.product', 'customer', 'address')
            ->orderBy('created_at', 'desc')->get();
//        return $orders;

        $app = $this->wechat->app(1);
        $jsApiList = ['chooseWXPay'];//支付
        $jssdk_json = $app->jssdk->buildConfig($jsApiList, false, false, true);
        $jssdk_config = json_decode($jssdk_json, true);

        return view('wechat.order.index', compact('orders', 'order_status', 'jssdk_config'));
    }


    /**
     * 购物车点击结算跳到下单页面，即check_out
     * 此页面需要的数据：用户的收货地址；要购买的商品信息；若购物车没有商品，跳回购物车页面。
     */
    public function checkout()
    {
        //$carts = Cart::with('product')->where('customer_id', session('wechat.customer.id'))->get();
        $carts = Cart::with('product.photo')->where('customer_id', 1)->get();
        $count = Cart::count_cart();

        //如果购物车没有商品，跳回购物车页面
        if ($carts->isEmpty()) {
            return redirect('/wechat/cart');
        }

        // $address = Address::find(session('wechat.customer.address_id'));
        $address = Address::find(1);
//        return $address;
        return view('wechat.order.checkout', compact('carts', 'count', 'address'));
    }

    /**
     * @param Request $request
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function pay(Request $request)
    {
        $address_id = $request->address_id;
        $cart_id = $request->cart_id;
        $order_id = $request->order_id;
        $app = $this->wechat->pay(1);
        $title = '';
        if ($order_id) {
            $order = Order::with('order_products.product')->find($order_id);
            $total_price = $order->total_price;
            $order_sn = $order->order_sn;
            $products = $order->order_products;
            foreach ($products as $product) {
                $title .= $product->product->name . '_';
            }

            $w_order = $app->order->queryByOutTradeNumber($order_sn);

            if ($w_order['trade_state'] == "NOTPAY") {

                $order_config = [
                    'body' => $title,
                    'out_trade_no' => date('YmdHms', time()) . '_' . session('wechat.customer.id'),
                    'total_fee' => $total_price * 100,
                    //'spbill_create_ip' => '', // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
                    'notify_url' =>'http://'.$_SERVER['HTTP_HOST'].'/api/wechat/paid', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                    'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
                    'openid' => session('wechat.customer.openid'),
                ];

                $order->order_sn = $order_config['out_trade_no'];
                $order->save();

                //重新生成预支付生成订单
                $result = $app->order->unify($order_config);
                if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS') {
                    $prepayId = $result['prepay_id'];

                    $config = $app->jssdk->sdkConfig($prepayId);
                    return response()->json($config);
                }
            }

        } else {
            $carts = Cart::with('product')->whereIn('id', $cart_id)->get();
            $count = Cart::count_cart();
            $total_price = $count['total_price'];
            $order_sn = date('YmdHms', time()) . '_' . session('wechat.customer.id');
            foreach ($carts as $cart) {
                $title .= $cart->product->name . '_';
            }

            $order_config = [
                'body' => $title,
                'out_trade_no' => $order_sn,
                'total_fee' => $total_price * 100,
                //'spbill_create_ip' => '', // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
                'notify_url' =>'http://'.$_SERVER['HTTP_HOST'].'/api/wechat/paid', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
                'trade_type' => 'JSAPI', // 请对应换成你的支付方式对应的值类型
                'openid' => session('wechat.customer.openid'),
            ];

            //生成订单
            $result = $app->order->unify($order_config);
            if ($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS') {
                $order = Order::create([
                    'customer_id' => session('wechat.customer.id'),
                    'order_sn' => $order_sn,
                    'total_price' => $total_price,
                ]);
                $address = Address::find($address_id);
                $order->address()->create([
                    'province' => $address->province,
                    'city' => $address->city,
                    'area' => $address->area,
                    'detail' => $address->detail,
                    'tel' => $address->tel,
                    'name' => $address->name
                ]);
                foreach ($carts as $cart) {
                    $result_ = $order->order_products()->create(['product_id' => $cart->product_id, 'num' => $cart->num]);
                    if ($result_) {
                        Cart::destroy($cart->id);
                    }
                }
                $prepayId = $result['prepay_id'];

                $config = $app->jssdk->sdkConfig($prepayId);
                return response()->json($config);
            }
        }

    }


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\Exception
     */
    public function paid(Request $request)
    {
        $app = $this->wechat->pay(1);
        $response = $app->handlePaidNotify(function($message, $fail){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $order = Order::where('order_sn', $message['out_trade_no'])->first();

            if (!$order || $order->pay_time) { // 如果订单不存在 或者 订单已经支付过了
                $order->status = 2; //支付成功,
                $order->save(); // 保存订单
                return true; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }
            ///////////// <- 建议在这里调用微信的【订单查询】接口查一下该笔订单的情况，确认是已经支付 /////////////
            if ($message['return_code'] === 'SUCCESS') { // return_code 表示通信状态，不代表支付状态
                // 用户是否支付成功
                if (array_get($message, 'result_code') === 'SUCCESS') {
                    $order->pay_time = date('Y-m-d H:m:s', time()); // 更新支付时间为当前时间

                    $order->status = 2; //支付成功,
                    $order->save(); // 保存订单
                }
            } else {
                return $fail('通信失败，请稍后再通知我');
            }

            return true; // 返回处理完成
        });

        return $response;
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        Order::destroy($id);
        OrderAddress::where('order_id', $id)->delete();
        OrderProduct::where('order_id', $id)->delete();
    }

}
