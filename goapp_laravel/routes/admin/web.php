<?php
Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {
    //后台登录
    Route::get('/login', 'adminloginController@index');
    //登录处理
    Route::post('/login', 'adminloginController@login');
    //后台登录主页
    Route::get('/index', 'EntryController@index');
    //退出
    Route::get('/logout', 'EntryController@logout');
    //修改密码
    Route::get('/changePassword', 'MyController@passwordForm');
    Route::post('/changePassword', 'MyController@changePassword');

});