<?php

namespace App\Http\Controllers\Wechat;

use App\Handlers\WechatConfigHandler;
use App\Models\Shop\Product;
use App\Models\Shop\ProductGallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Category;

class ProductController extends Controller
{
    protected $jssdk;

    function __construct(WechatConfigHandler $wechat)
    {
        view()->share([
            '_category' => 'on'
        ]);

        $app = $wechat->app(1);
        $this->jssdk = $app->jssdk;
    }


    /** 商品列表,首页的全局搜索：输入关键词后搜索结果跳到商品列表页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
//        $where = function ($query) use ($request) {
//
//            if ($request->has('searchword')) {
//                if ($request->has('searchword') and $request->searchword != '') {
//                    $search = "%" . $request->searchword . "%";
//                    $query->where('name', 'like', $search);
//                }
//            }
//        };
        $id = $request['category_id'];
        $searchword = $request['searchword'];

        if ($searchword) {
            $search = "%" . $request->searchword . "%";
            $products = Product::where('name', 'like', $search)->get();
        }
        if ($id) {
            $categories = Category::with('photo')->with([
                'products' => function ($query) {
                    $query->with('photo');
                }
            ])
                ->orderBy('created_at')
                ->find($id);

            $products = $categories['products'];
        }

        return view('wechat.products.index', compact('products'));
    }


    /** 搜索
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        $products = Product::where('is_recommend', true)->orderBy('is_top', 'desc')->orderBy('created_at')->get();

        return view('wechat.products.search', compact('products'));
    }


    /** 所有分类
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category()
    {
        $categories = Category::with('children')->orderBy('sort_order', 'desc')
            ->where('parent_id', 0)->get();
        return view('wechat.products.category', compact('categories'));
    }


    /**
     *  商品详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function show($id)
    {

        $jsApiList = ['onMenuShareTimeline', 'onMenuShareAppMessage'];//分享给好友 分享到朋友圈

        $jssdk_json = $this->jssdk->buildConfig($jsApiList, false, false, true);

        $jssdk_config=json_decode($jssdk_json,true);

        //获取JSSDK的配置数组，默认返回 JSON 字符串，当 $json 为 false 时返回数组，你可以直接使用到网页中。
        // $app->jssdk->setUrl($url)
        //设置当前URL，如果不想用默认读取的URL，可以使用此方法手动设置，通常不需要。

        $product = Product::find($id);
        $product_galleries = ProductGallery::where(array('product_id' => $id))->get();
        $recommends = Product::with('photo')->where('is_recommend', true)->where('id', '<>', $id)
            ->orderBy('is_top', 'desc')->get();

        return view('wechat.products.show', compact('product', 'recommends', 'product_galleries', 'jssdk_config'));
    }

}
