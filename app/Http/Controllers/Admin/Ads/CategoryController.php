<?php

namespace App\Http\Controllers\Admin\Ads;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Ads\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        view()->share('categories', Category::get_categories());
    }

    /**
     * 分类列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function index()
    {
        return view('admin.ads.category.index');
    }

    /**
     * 新增
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.ads.category.create');
    }

    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Category::create($request->all());
        Category::clear();
        return redirect(route('ads.category.index'))->with('notice', '添加分类成功');
    }

    /**
     * 编辑
     * @param $id
     * @return $this
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.ads.category.edit', compact('category'));
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        Category::clear();
        return redirect(route('ads.category.index'))->with('notice', '编辑成功~');
    }

    /**
     * Ajax排序
     * @param Request $request
     * @return array
     */
    function sort_order(Request $request)
    {
        $category = Category::find($request->id);
        $category->sort_order = $request->sort_order;
        $category->save();
        Category::clear();

    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function destroy($id)
    {
        if (!Category::check_ads($id)) {
            return back()->with('alert', '当前分类有广告，请先将对应广告删除后再尝试删除~');
        }

        Category::destroy($id);
        Category::clear();
        return back()->with('notice', '删除成功');
    }
}
