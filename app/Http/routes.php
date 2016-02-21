<?php

// 路由文件
// 在这里,你将会在一个应用程序中注册所有的路线。
// 这是小菜一碟。只是告诉Laravel uri应该回应给控制器调用请求URI。

Route::get('/', function () {
    return view('welcome');
});

//应用程序路由
// 这条路线组应用“web”中间件组每一个路线它包含。
// “web”中定义中间件集团是HTTP内核和包括会话状态,CSRF保护等等。

Route::group(['middleware' => ['web']], function () {
  Route::auth();

  Route::get('/home', 'HomeController@index');
});

//前台路由

//后台路由
// Route::delete('/task/{task}', 'TaskController@destroy');
Route::get('/admin','Admin\AdminController@index');
Route::group(['prefix' => 'admin'], function()
{
  Route::get('/','Admin\AdminController@index');
});

//任务路由
Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');

//权限验证路由
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// Route::get('/admin/auth','Admin\AuthController@redirectToProvider');
// Route::get('/admin/callback','Admin\AuthController@handleProviderCallback');
//注册用户路由
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
