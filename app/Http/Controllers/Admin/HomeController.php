<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth, DB;

class HomeController extends Controller
{
    /**
     * 系统后台首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        return view('admin.index', compact('user'));
    }

}
