<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'log'], function () {
    //记录日志

    Route::namespace('Backend\Admin')->group(function () {
        //命名空间定位于Backend\Admin下面

        Route::get('admin/login/index', 'LoginController@index');
        Route::post('admin/login/index', 'LoginController@login');

        Route::group(['middleware' => 'islogin'], function () {
            Route::get('admin/index/index', 'IndexController@index');

            Route::resource('admin/user/index', 'UserController');

            Route::resource('admin/key/index','KeyController');

        });
    });

    Route::group(['middleware' => 'islogin'], function () {
        //判断是否登录

        Route::namespace('Backend\Menu')->group(function () {

            Route::resource('menu/menu/index', 'MenuController');

            Route::resource('menu/node/index', 'NodeController');

        });

        Route::namespace('Backend\Shop')->group(function (){

            Route::resource('shop/index/index','IndexController');

        });

    });


});