<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\Shop\Express;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpressController extends Controller
{
    /**
     * 快递列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $expresses = Express::orderBy('sort_order')->paginate(config('admin.page_size'));
        return view('admin.shop.express.index', compact('expresses'));
    }

    /**
     * 新增
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.shop.express.create');
    }

    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Express::create($request->all());
        return redirect(route('shop.express.index'))->with('notice', '新增物流成功~');
    }

    /**
     * 编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $express = Express::find($id);
        return view('admin.shop.express.edit', compact('express'));
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $express = Express::find($id);
        $express->update($request->all());
        return back()->with('notice', '修改物流信息成功');
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Express::destroy($id);
        return back()->with('notice', '删除物流成功');
    }

    /**
     * Ajax排序
     * @param Request $request
     * @return array
     */
    function sort_order(Request $request)
    {
        $express = Express::find($request->id);
        $express->sort_order = $request->sort_order;
        $express->save();

    }

    /**
     * Ajax修改属性
     * @param Request $request
     * @return array
     */
    function is_something(Request $request)
    {
        $attr = $request->attr;
        $express = Express::find($request->id);
        $value = $express->$attr ? false : true;
        $express->$attr = $value;
        $express->save();

    }
}
