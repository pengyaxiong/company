<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\Shop\Category;
use App\Models\System\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('admin.shop.category.index');
    }

    /**
     * 新增
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.shop.category.create');
    }

    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $photo = Photo::create(['identifier' => $request->image]);
        $category=$request->all();
        $photo->category()->create($category);
        Category::clear();
        return redirect(route('shop.category.index'))->with('notice', '添加栏目成功~');
    }

    /**
     * 编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.shop.category.edit', compact('category'));
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
        $category->photo()->update(['identifier' => $request->image]);
        return redirect(route('shop.category.index'))->with('notice', '编辑成功~');
    }

    /**
     * Ajax修改属性
     * @param Request $request
     * @return array
     */
    function is_something(Request $request)
    {
        $attr = $request->attr;
        $category = Category::find($request->id);
        $value = $category->$attr ? false : true;
        $category->$attr = $value;
        $category->save();
        Category::clear();

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
        if (!Category::check_children($id)) {
            return back()->with('alert', '当前分类有子分类，请先将子分类删除后再尝试删除~');
        }

        if (!Category::check_products($id)) {
            return back()->with('alert', '当前分类有商品，请先将对应商品删除后再尝试删除~');
        }

        Category::destroy($id);
        Category::clear();
        return back()->with('notice', '删除成功');
    }
}
