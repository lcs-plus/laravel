<?php
/**
 * Created by PhpStorm.
 * User: damai
 * Date: 2019/3/27
 * Time: 13:33
 */

namespace App\Http\Controllers\Backend\Admin;


use App\Http\Controllers\Controller;
use App\Models\Backend\User;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function index()
    {
//        14e1b600b1fd579f47433b88e8d85291

        return view('backend.admin.login.index');

    }

    public function login(Request $request)
    {

        $data = $request->all();

        $user = User::where(['email'=>$data['email']])->first();

        if (empty($user)) {
            \App\Models\Backend\Log::addTable($request,'登录失败','users',$data['email']);
            return ['code' => 0, 'data' => '', 'message' => '邮箱或登录密码错误'];
        }

        $data['password'] = md5(md5($data['password']));

        if ($data['password'] != $user['password']) {
            \App\Models\Backend\Log::addTable($request,'登录失败','users',$data['email']);
            return ['code' => 0, 'data' => '', 'message' => '邮箱或登录密码错误'];
        }

        \App\Models\Backend\Log::addTable($request,'登录成功','users',$data['email']);

        $request->session()->put('userinfo', $user);

        return ['code' => 1, 'data' => '', 'message' => '登录成功'];

    }

}

