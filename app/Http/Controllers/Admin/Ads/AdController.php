<?php

namespace App\Http\Controllers\Admin\Ads;

use App\Models\System\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Ads\Ad;
use App\Models\Ads\Category;


class AdController extends Controller
{
    public function __construct()
    {
        view()->share('categories', Category::get_categories());
    }

    /**
     * 广告列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //查找
        $where = function ($query) use ($request) {
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }
        };

        $ads = Ad::with('category', 'photo')->where($where)->orderBy('created_at')->paginate(env('PAGE_SIZE'));
        return view('admin.ads.ad.index', compact('ads'));
    }

    /**
     * 新增
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function create()
    {
        return view('admin.ads.ad.create');
    }

    /**
     * 保存
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function store(Request $request)
    {
        $photo = Photo::create(['identifier' => $request->image]);
        $ads = $request->all();
        $photo->ad()->create($ads);
        return redirect(route('ads.ad.index'))->with('notice', '新增成功~');
    }

    /**
     * 编辑
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function edit($id)
    {
        $ad = Ad::find($id);
        return view('admin.ads.ad.edit', compact('ad'));
    }

    /**
     * 更新
     * @param Request $request
     * @param Ad $ad
     * @return \Illuminate\Http\RedirectResponse
     */
    function update(Request $request, $id)
    {
        $ad = Ad::find($id);
        $ad->update($request->all());

        $ad->photo()->update(['identifier' => $request->image]);

        return redirect(route('ads.ad.index'))->with('notice', '编辑成功~');
    }

    /**
     * 删除到回收站
     * @param Ad $ad
     * @return \Illuminate\Http\RedirectResponse
     */
    function destroy(Ad $ad)
    {
        $ad->delete();
        return back()->with('notice', '被删文章已进入回收站~');
    }

    /**
     * 永久删除
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function force_destroy($id)
    {
        Ad::withTrashed()->where('id', $id)->forceDelete();
        return back()->with('notice', '删除成功');
    }

    /**
     * 多选删除到回收站
     * @param Request $request
     * @return array
     */
    function destroy_checked(Request $request)
    {
        $checked_id = $request->input("checked_id");
        Ad::destroy($checked_id);
    }

    /**
     * 多选永久删除
     * @param Request $request
     * @return array
     */
    function force_destroy_checked(Request $request)
    {
        $checked_id = $request->input("checked_id");
        Ad::withTrashed()->whereIn('id', $checked_id)->forceDelete();
    }

    /**
     * 还原
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        Ad::withTrashed()->where('id', $id)->restore();
        return back()->with('notice', '还原成功');
    }

    /**
     * 多选还原
     * @param Request $request
     * @return array
     */
    public function restore_checked(Request $request)
    {
        $checked_id = $request->input("checked_id");
        Ad::withTrashed()->whereIn('id', $checked_id)->restore();
    }

    /**
     * 回收站
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function trash()
    {
        $ads = Ad::with('category')->onlyTrashed()->paginate(config('admin.page_size'));
        return view('admin.ads.ad.trash', compact('ads'));
    }

    /**
     * Ajax排序
     * @param Request $request
     * @return array
     */
    function sort_order(Request $request)
    {
        $ad = Ad::find($request->id);
        $ad->sort_order = $request->sort_order;
        $ad->save();
    }
}
