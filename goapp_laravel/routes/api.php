<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//api/post;
Route::get('/posts','PostsController@index');
//输出所有商铺数据
Route::get('/post/{post}','PostsController@show');
//模拟输出所选{id}数据
Route::get('/users','UserController@index');
//展示所有用户
Route::get('/user/{user}','UserController@show');
//展示指定用户
Route::post('/user/delete/{user}','UserController@delete');
//删除指定用户

Route::post('/user/{user}','UserController@show');
//修改用户信息
Route::post('/user/change/{user}','UserController@change');



Route::post('/register','Auth\RegisterController@register');
Route::post('/login','Auth\LoginController@login');