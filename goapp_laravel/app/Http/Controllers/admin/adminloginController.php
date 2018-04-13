<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class adminloginController extends Controller
{
    protected $code;
    public  function  index(){
        return view('admin.index');
    }
    //管理员登录
    public function  login(Request $request)
    {
        //验证
       $status=Auth::guard('admin')->attempt([
          'username'=>$request->input('usr'),
          'password'=>$request->input('pwd'),
       ]);
       if($status){
          return $code=1;
       }
        //return \Redirect::back()->withErrors("用户名密码错误");

    }
    public function logout(){
       // Auth::guard('admin')->logout();
    }
}
