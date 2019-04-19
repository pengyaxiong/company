<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shop\Prize;

class DrawController extends Controller
{
    /**
     * 加载用户抽奖大转盘
     */
    public function index()
    {
        return view('wechat.draw.index');
    }

    public function store(Request $request)
    {
//        return $request->all();
        $prizes = Prize::all();
        foreach ($prizes as $key => $value) {
            $prize_name[] = $value;
        }

        return $prize_name;
    }
}
