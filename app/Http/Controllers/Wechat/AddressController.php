<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Ads\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Address;
use App\Models\Shop\Customer;

class AddressController extends Controller
{
    /**
     * 地址列表
     */
    public function index()
    {
        //查出当前用户所有地址
        $addresses = Address::where('customer_id', session('wechat.customer.id'))->get();
//        return $addresses;
        return view('wechat.address.index', compact('addresses'));
    }


    /**加载新建地址页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('wechat.address.create');
    }


    /**保存地址
     * @param Request $request
     */
    public function store(Request $request)
    {
        $pca = explode(",", $request->pca);

        Address::create([
            'customer_id' => session('wechat.customer.id'),
            'name' => $request->name,
            'province' => $pca[0],
            'city' => $pca[1],
            'area' => $pca[2],
            'tel' => $request->tel,
            'detail' => $request->detail,
        ]);
    }


    /** 设置默认地址
     * @param Request $request
     */
    public function default_address(Request $request)
    {
//        return $request->all();
        Customer::where('id', session('wechat.customer.id'))->update(['address_id' => $request->address_id]);

        //重新设置session
        $customer = session()->get('wechat.customer');
        $customer['address_id'] = $request->address_id;
        session()->put('wechat.customer', $customer);
    }

    /**
     * 会员中心--地址管理--首页
     */
    public function manage()
    {
        //查出当前用户所有地址
        $addresses = Address::where('customer_id', session('wechat.customer.id'))->get();
        return view('wechat.address.manage', compact('addresses'));
    }


    /** 会员中心--地址管理--删除地址
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Address::destroy($id);
        return back();
    }


    /** 会员中心--地址管理--编辑地址
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $address = Address::find($id);
        return view('wechat.address.edit', compact('address'));
    }


    /** 会员中心--地址管理--执行编辑
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $pca = explode(",", $request->pca);

        Address::where('id', $id)->update([
            'name' => $request->name,
            'province' => $pca[0],
            'city' => $pca[1],
            'area' => $pca[2],
            'tel' => $request->tel,
            'detail' => $request->detail,
        ]);
    }


}
