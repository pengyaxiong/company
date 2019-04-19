<?php

namespace App\Http\Controllers\Admin\Wechat;

use App\Models\System\Wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $config = Wechat::first();
        return view('admin.wechat.edit', compact('config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $config = Wechat::first();
        $config->update($request->all());
        return back()->with('notice', '修改成功~');
    }

}
