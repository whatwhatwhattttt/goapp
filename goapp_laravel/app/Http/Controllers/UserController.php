<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function  index(){
        return User::paginate(10);
    }
    //首页展示10个用户
    public function  show(User $user){
        return $user;
    }
    //拟态框显示当前用户
    public  function change(User $user){
        $this->validate(request(),[
            'name'=>'required|string|max:100|min:5',
            'password'=> 'required|string|min:5',
            'id_card'=> 'required|string|max:18|min:18'
        ]);
        $user->name=\request('name');
        $user->password=\bcrypt(request('password'));
        $user->nickname=\request('nickname');
        $user->sex=\request('sex');
        $user->realname=\request('realname');
        $user->QQ=\request('QQ');
        $user->email=\request('email');
        $user->id_card=\request('id_card');
        $user->save();
        return [
            'error' => 0,
            'msg' => '修改成功',
        ];
    }
    //修改用户信息
    public function  delete(User $user){
        $user->delete();
        return [
            'error' => 0,
            'msg' => '删除用户成功',
        ];
    }
    //删除指定用户
}
