<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\Shop\Express;
use App\Models\Shop\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct()
    {
        view()->share('order_status', config('admin.order_status'));
    }

    /**
     * 订单列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {
            if ($request->has('id') and $request->id != '') {
                $query->where('id', $request->id);
            }

            if ($request->has('customer_id') and $request->customer_id != '') {
                $query->where('customer_id', $request->customer_id);
            }

            if ($request->has('total_price') and $request->total_price != '') {

                $status = is_numeric($request->total_price) ? '=' : substr($request->total_price, 0, 1);
                $total_price = substr($request->total_price, 1);

                switch ($status) {
                    case '>':
                        $query->where('total_price', '>=', $total_price);
                        break;
                    case '<' :
                        $query->where('total_price', '<=', $total_price);
                        break;
                    //用户直接输入的是金额,那么就等于
                    default:
                        $query->where('total_price', $request->total_price);
                }
            }

            if ($request->has('status') and $request->status != '-1') {
                $query->where('status', $request->status);
            }

            if ($request->has('created_at') and $request->created_at != '') {
                $time = explode(" ~ ", $request->input('created_at'));
                foreach ($time as $k => $v) {
                    $time["$k"] = $k == 0 ? $v . " 00:00:00" : $v . " 23:59:59";
                }
                $query->whereBetween('created_at', $time);
            }
        };

        $orders = Order::with('order_products.product', 'customer', 'address')->where($where)
            ->orderBy('created_at', 'desc')
            ->paginate(config('admin.page_size'));

        return view('admin.shop.order.index', compact('orders'));
    }

    /**
     * 显示订单
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $expresses = Express::orderBy('sort_order')->get();
        $order = Order::with('address', 'express', 'customer', 'order_products.product')->find($id);
        return view('admin.shop.order.show', compact('order', 'expresses'));
    }

    /**
     * 更新订单状态为：待发货
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $order = order::find($id);
        $order->express_code = $request->express_code;
        //只有当前在未发货状态下，才修改订单状态
        if ($order->status == 1) {
            $order->status = 2;
        }
        $order->save();
        return back()->with('notice', '发货成功');
    }

    /**
     * 更新状态为：配货
     * @param Request $request
     * @return array
     */
    public function picking(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 3;
        $order->picking_time = Carbon\Carbon::now();
        $order->save();

    }

    /**
     * 更新状态为：发货
     * @param Request $request
     * @return array
     */
    public function shipping(Request $request)
    {
        $order = Order::find($request->id);
        if ($request->status == 3) {
            $order->status = 4;
            $order->shipping_time = Carbon\Carbon::now();
        }

        $order->express_code = $request->express_code;
        $order->express_id = $request->express_id;
        $order->save();

    }

    /**
     * 更新状态为：交易成功
     * @param Request $request
     * @return array
     */
    public function finish(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 5;
        $order->finish_time = Carbon\Carbon::now();
        $order->save();

    }
}
