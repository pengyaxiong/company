<?php

namespace App\Http\Controllers\Admin\Wechat;

use EasyWeChat\Kernel\Exceptions\HttpException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Handlers\WechatConfigHandler;
use Cache;

class MenuController extends Controller
{
    protected $menu;

    public function __construct(WechatConfigHandler $wechat)
    {
        $app = $wechat->app(1);
        $this->menu = $app->menu;
    }

    /**
     * 编辑微信菜单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function edit()
    {
        //$menus = $this->menu->list();
        try {
            $buttons = Cache::rememberForever('wechat_config_menus', function () {
                $current = $this->menu->current();
                return $current['selfmenu_info']['button'];
            });
        } catch (HttpException $e) {
            $buttons = [];
        }
        $b_c = count($buttons);

        for ($i = $b_c; $i < 3; $i++) {
            $buttons[$i] = array('type' => 'view', 'name' => '未设置');
        }

        return view('admin.wechat.menu.edit', compact('buttons'));
    }

    /**
     * 更新微信菜单
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function update(Request $request)
    {
        $buttons = wechat_menus($request->buttons);
        $this->menu->create($buttons);
        Cache::forget('wechat_config_menus');
        return back()->with('notice', '您已成功设置菜单，请取消关注后，再重新关注~');
    }

    /**
     * 删除微信菜单
     * @return \Illuminate\Http\RedirectResponse
     */
    function destroy($id)
    {
        $this->menu->delete($id);
        Cache::forget('wechat_config_menus');
        return back()->with('notice', '您已成功删除菜单，请取消关注后，再重新关注~');
    }
}
