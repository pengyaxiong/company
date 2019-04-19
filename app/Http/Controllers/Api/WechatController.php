<?php

namespace App\Http\Controllers\Api;

use App\Handlers\WechatConfigHandler;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Product, App\Models\Shop\Order, App\Models\Shop\Customer;

class WechatController extends Controller
{
    protected $wechat;

    public function __construct(WechatConfigHandler $wechat)
    {
        $this->wechat = $wechat;
    }

    /**
     * @param $account
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \ReflectionException
     */
    public function serve($account)
    {
        $app = $this->wechat->app($account);


        $app->server->push(function($message){
            switch ($message['MsgType']) {
                case 'event':
                    switch ($message['Event']) {
                        //关注事件
                        case 'subscribe':
                            return  '欢迎关注 武汉嘉悦天辰! 亲, 还在等什么, 赶紧去嘉悦天辰小卖部买东西啊~';
                            break;
                        //取消关注
                        case 'unsubscribe':
                            return  '我还会回来的~';
                            break;

                        //点击事件
                        case 'CLICK':
                            switch ($message['EventKey']) {
                                case 'recommend':
                                    return $this->is_recommend();
                                    break;

                                case 'new':
                                    return $this->is_new();
                                    break;

                                case 'hot':
                                    return $this->is_hot();
                                    break;

                                case 'order':
                                    return $this->order($message['FromUserName']);
                                    break;
                            }
                            break;
                    }
                    break;
                case 'text':
                    switch ($message['Content']) {
                        case '精选':
                        case '推荐':
                        case '精选推荐':
                        case 'recommend':
                            return $this->is_recommend();
                            break;

                        case '新品':
                        case '新品到货':
                        case 'new':
                            return $this->is_new();
                            break;

                        case '人气':
                        case '热卖':
                        case '人气热卖':
                        case 'hot':
                            return $this->is_hot();
                            break;

                        case '我的订单':
                        case '订单':
                        case 'order':
                            return $this->order($message['FromUserName']);
                            break;

                        default:
                            return $this->default_msg();
                    }
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'voice':
                    switch ($message['Recognition']) {
                        case '精选。':
                        case '推荐。':
                        case '精选推荐。':
                            return $this->is_recommend();
                            break;

                        case '新品。':
                        case '新品到货。':
                            return $this->is_new();
                            break;

                        case '人气。':
                        case '热卖。':
                        case '人气热卖。':
                            return $this->is_hot();
                            break;

                        case '订单。':
                        case '我的订单。':
                            return $this->order($message['FromUserName']);
                            break;

                        default:
                            return '您说的是:' . $message['Recognition'] . '?';
                    }
                    break;
                case 'video':
                    return '收到视频消息';
                    break;
                case 'location':
                    return '收到坐标消息';
                    break;
                case 'link':
                    return '收到链接消息';
                    break;
                case 'file':
                    return '收到文件消息';
                // ... 其它消息
                default:
                    return '收到其它消息';
                    break;
            }
        });



        $response = $app->server->serve();
        return $response;
    }

    /**
     * @param $account
     * @return \Illuminate\Http\RedirectResponse
     */
    public function oauth_callback($account)
    {
        $app = $this->wechat->app($account);
        $user = $app->oauth->user();
        session(['wechat.oauth_user' => $user->toArray()]);
        //不管在哪个页面检测用户登录状态，都要写入session值：target_url
        $targetUrl = session()->has('target_url') ? session('target_url') : '/' ;
        //header('location:'. $targetUrl);
        return redirect()->to($targetUrl);
    }
    /**
     * 精选推荐
     * @return array
     */
    private function is_recommend()
    {
        $products = Product::with('photo')->where('is_recommend', true)
            ->orderBy('is_top', "desc")
            ->orderBy('created_at')
            ->take(6)
            ->get();

        foreach ($products as $p) {

            $items = [
                new NewsItem([
                    'title' => $p->name,
                    'description' => $p->description,
                    'url' => env('WECHAT_DOMAIN') . '/wechat/product/' . $p->id,
                    'image' => $p->photo->identifier ? env('QINIU_IMAGES_LINK') . $p->photo->identifier : '',
                ]),
            ];
            $news = new News($items);

            return $news;
        }

    }

    /**
     * 人气热卖
     * @return array
     */
    private function is_hot()
    {
        $products = Product::with('photo')->where('is_hot', true)
            ->orderBy('is_top', "desc")
            ->orderBy('created_at')
            ->take(6)
            ->get();

        foreach ($products as $p) {

            $items = [
                new NewsItem([
                    'title' => $p->name,
                    'description' => $p->description,
                    'url' => env('WECHAT_DOMAIN') . '/wechat/product/' . $p->id,
                    'image' => $p->photo->identifier ? env('QINIU_IMAGES_LINK') . $p->photo->identifier : '',
                ]),
            ];
            $news = new News($items);

            return $news;
        }

    }

    /**
     * @return News
     */
    private function is_new()
    {
        $products = Product::with('photo')->where('is_new', true)
            ->orderBy('is_top', "desc")
            ->orderBy('created_at')
            ->take(6)
            ->get();

        foreach ($products as $p) {

            $items = [
                new NewsItem([
                    'title' => $p->name,
                    'description' => $p->description,
                    'url' => env('WECHAT_DOMAIN') . '/wechat/product/' . $p->id,
                    'image' => $p->photo->identifier ? env('QINIU_IMAGES_LINK') . $p->photo->identifier : '',
                ]),
            ];
            $news = new News($items);

            return $news;
        }



    }

    /**
     * 我的订单
     * @param $openid
     * @return array|string
     */
    function order($openid)
    {
        $customer = Customer::where('openid', $openid)->first();

        //如果用户还不存在,直接返回
        if (!$customer) {
            return '你没有未完成的订单, 马上去购物吧~';
        }

        $order_status = config('admin.order_status');
        $orders = Order::where('status', '<', 5)
            ->where('customer_id', $customer->id)
            ->with('order_products.product.photo')
            ->orderBy('status')
            ->orderBy('id', 'desc')
            ->take(6)
            ->get();

        if ($orders->isEmpty()) {
            return '你没有未完成的订单, 马上去购物吧~';
        }

        $news = [];
        foreach ($orders as $order) {
            $news[] = new News([
                'title' => '订单号' . $order->id . " (" . $order_status[$order->status] . ")",
                'url' => env('WECHAT_DOMAIN') . '/wechat/order/' . $order->id,
                'image' => $order->order_products->first()->product->photo->identifier ? env('QINIU_IMAGES_LINK') . $order->order_products->first()->product->photo->identifier : '',
            ]);
        }
        return $news;
    }

    /**
     * 默认消息
     * @return string
     */
    function default_msg()
    {
        return '有趣的问题~';
    }
}