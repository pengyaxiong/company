<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Models\Shop\Brand;
use App\Models\Shop\Category;
use App\Models\Shop\Product;
use App\Models\Shop\ProductGallery;
use App\Models\System\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * 商品的各种属性
     */
    private function attributes()
    {
        view()->share([
            'categories' => Category::get_categories(),
            'brands' => Brand::orderBy('sort_order')->get(),
            'filter_categories' => Category::filter_categories()
        ]);
    }

    /**
     * 商品列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {

            if ($request->has('name') and $request->name != '') {

                $search = "%" . $request->name . "%";
                $query->where('name', 'like', $search);
            }

            if ($request->has('category_id') and $request->category_id != '') {

                $category_id = $request->category_id;
                $product_ids = \DB::table('category_product')->where('category_id', $category_id)->pluck('product_id');

                $query->whereIn('id', $product_ids);
            }

            if ($request->has('brand_id') and $request->brand_id != '-1') {

                $query->where('brand_id', $request->brand_id);
            }

            if ($request->has('is_onsale') and $request->is_onsale != '-1') {

                $query->where('is_onsale', $request->is_onsale);
            }

            if ($request->has('is_top')) {
                $query->where('is_top', true);
            }

            if ($request->has('is_recommend')) {
                $query->where('is_recommend', true);
            }

            if ($request->has('is_hot')) {
                $query->where('is_hot', true);
            }

            if ($request->has('is_new')) {
                $query->where('is_new', true);
            }

            if ($request->has('created_at') and $request->created_at != '') {
                $time = explode(" ~ ", $request->input('created_at'));
                $start = $time[0] . ' 00:00:00';
                $end = $time[1] . ' 23:59:59';
                $query->whereBetween('created_at', [$start, $end]);
            }
        };

        $products = Product::with('brand', 'categories')->where($where)->paginate(env('PAGE_SIZE'));

        $this->attributes();
        return view('admin.shop.product.index', compact('products'));
    }


    /**
     * 新增
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function create()
    {
        $this->attributes();
        return view('admin.shop.product.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
        ]);
        $photo = Photo::create(['identifier' => $request->image]);
        $product = $photo->product()->create($request->all());

        //相册
        if ($request->has('imgs')) {
            foreach ($request->imgs as $img) {
                $product->product_galleries()->create(['identifier' => $img]);
            }
        }

        //商品所属栏目
        $product->categories()->sync($request->category_id);
        return redirect(route('shop.product.index'))->with('notice', '新增成功~');
    }

    /**
     * 编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function edit($id)
    {
        $product = Product::with('brand', 'categories', 'product_galleries')->find($id);
        //当前商品对应的分类id
        $p_categories = $product->categories->pluck('id');
        $this->attributes();

        return view('admin.shop.product.edit', compact('product', 'p_categories'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
        ]);

        $product = Product::find($id);

        $product->update($request->all());

        $product->photo()->update(['identifier' => $request->image]);
        if ($request->has('imgs')) {
            foreach ($request->imgs as $img) {

                $product->product_galleries()->create(['identifier' => $img]);
            }
        }
        $product->categories()->sync($request->category_id);
        return redirect(route('shop.product.index'))->with('notice', '修改成功~');
    }

    /**
     * 删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function destroy($id)
    {
        if (!Product::check_orders($id)) {
            return back()->with('alert', '当前商品拥有对应的订单，无法删除~');
        }
        Product::destroy($id);

        return back()->with('notice', '被删商品已进入回收站~');
    }

    /**
     * 永久删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function force_destroy($id)
    {
        Product::withTrashed()->where('id', $id)->forceDelete();
        ProductGallery::where('product_id', $id)->delete();
        return back()->with('notice', '删除成功');
    }

    /**
     * 多选删除
     * @param Request $request
     */
    function destroy_checked(Request $request)
    {
        $checked_id = $request->input("checked_id");
        $delete_id = [];

        //检测商品是否能删除
        foreach ($checked_id as $id) {
            if (Product::check_orders($id)) {
                $delete_id[] = $id;
            }
        }

        Product::destroy($delete_id);
    }

    /**
     * 多选永久删除
     * @param Request $request
     * @return array
     */
    function force_destroy_checked(Request $request)
    {
        $checked_id = $request->input("checked_id");
        ProductGallery::whereIn('product_id', $checked_id)->delete();
        Product::withTrashed()->whereIn('id', $checked_id)->forceDelete();
    }

    /**
     * 还原
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        Product::withTrashed()->where('id', $id)->restore();
        return back()->with('notice', '还原成功');
    }

    /**
     * 多选还原
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore_checked(Request $request)
    {
        $checked_id = $request->input("checked_id");
        Product::withTrashed()->whereIn('id', $checked_id)->restore();
        return back()->with('notice', '还原成功');
    }

    /**
     * 回收站
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        $products = Product::with('categories')->with('brand')->onlyTrashed()->paginate(config('admin.page_size'));
        return view('admin.shop.product.trash', compact('products'));
    }

    /**
     * Ajax删除相册图片
     * @param Request $request
     * @return array
     */
    function destroy_gallery(Request $request)
    {
        ProductGallery::destroy($request->gallery_id);
    }

    /**
     * 更新库存
     * @param Request $request
     * @return array
     */
    function change_stock(Request $request)
    {
        $product = Product::find($request->id);
        $product->stock = $request->stock;
        $product->save();
    }

    /**
     * Ajax修改属性
     * @param Request $request
     * @return array
     */
    function is_something(Request $request)
    {
        $attr = $request->attr;
        $product = Product::find($request->id);
        $value = $product->$attr ? false : true;
        $product->$attr = $value;
        $product->save();
    }
}
