<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
class adminloginController extends Controller
{
    public  function  index(){
        return view('admin.index');
    }
    //管理员登录
    public function  login(Request $request)
    {
        //验证
       $status=Auth::guard('admin')->attempt([
          'username'=>$request->input('username'),
          'password'=>$request->input('password'),
       ]);
       if($status){
           return 1;
       }
           return 0;

    }
    public function logout(){

    }
}
