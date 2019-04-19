<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\Shop\Brand;
use App\Models\System\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * 品牌列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $where = function ($query) use ($request) {
            if ($request->has('keyword') and $request->keyword != '') {
                $search = "%" . $request->keyword . "%";
                $query->where('name', 'like', $search);
            }
        };

        $brands = Brand::where($where)->orderBy('sort_order')->paginate(config('admin.page_size'));
        return view('admin.shop.brand.index', compact('brands'));
    }
    /**
     * 新增
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.shop.brand.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:brands|max:255',
            'url' => 'url',
        ]);
        $photo = Photo::create(['identifier' => $request->image]);
        $brand = $request->all();
        $photo->brand()->create($brand);
        return redirect(route('shop.brand.index'))->with('notice', '新增品牌成功~');
    }

    /**
     * 修改
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.shop.brand.edit', compact('brand'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'url' => 'url',
        ]);

        $brand = Brand::find($id);
        $brand->update($request->all());
        $brand->photo()->update(['identifier' => $request->image]);
        return redirect(route('shop.brand.index'))->with('notice', '编辑品牌成功~');
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (!Brand::check_products($id)) {
            return back()->with('alert', '当前品牌下有商品，请先将对应商品删除后再尝试删除~');
        }

        Brand::destroy($id);
        return back()->with('notice', '删除品牌成功~');
    }

    /**
     * Ajax排序
     * @param Request $request
     * @return array
     */
    function sort_order(Request $request)
    {
        $brand = Brand::find($request->id);
        $brand->sort_order = $request->sort_order;
        $brand->save();
    }

    /**
     * Ajax修改属性
     * @param Request $request
     * @return array
     */
    function is_something(Request $request)
    {
        $attr = $request->attr;
        $brand = Brand::find($request->id);
        $value = $brand->is_show ? false : true;
        $brand->$attr = $value;
        $brand->save();
    }
}
