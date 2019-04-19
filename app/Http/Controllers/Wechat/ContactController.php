<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Information\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('wechat.contact.index');
    }


    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $user = session('wechat.oauth_user.default');
        $original = $user->original;
        $nickname = $original['nickname'];
        $messages = [
            'name.required' => '请填写姓名!',
            'mobile.required' => '请填写联系电话',
            'contact.required' => '请填写反馈信息!'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile' => 'required',
            'contact' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return error_data($validator->errors()->first());
            exit;
        }


        $result = Contact::create([
            'name' => $request->name,
            'nickname' => $nickname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'contact' => $request->contact,
        ]);

        if ($result) {
            return success_data('反馈成功');
        } else {
            return error_data('反馈失败');
        }
    }

}
