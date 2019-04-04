<?php

namespace App\Http\Controllers\Api\User;

use App\Models\System\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function check_login(Request $request)
    {
        $name = $request->name;
        $password = $request->password;

        if (Auth::attempt(['name' => $name, 'password' => $password])) {

            $user = Auth::user();

            $state = $user->state;

            if ($state == 1) {
                return success_data('登陆成功');
            } else {
                return error_data('您被限制登陆');
            }
        } else {
            return error_data('账号密码错误');
        }
    }


    public function test()
    {
        $users = User::all();
        return success_data('成功', $users);
    }
}
