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

Route::group(['prefix' => '/admin'], function () {
    Route::get('/login', 'Admin\PublicController@login');
    Route::post('/login', 'Admin\PublicController@loginAct');
    Route::get('/verify', 'Admin\PublicController@verify');

    Route::group(['middleware' => 'loginAuth:admin'], function () {
        Route::get('/', ['uses' => 'Admin\IndexController@index', 'as' => 'index']);
        Route::get('/index', ['uses' => 'Admin\IndexController@index', 'as' => 'index']);
        Route::resource('/user', 'Admin\UserController');
        Route::resource('/role', 'Admin\RoleController');
        Route::resource('/permission', 'Admin\PermissionController');
        Route::resource('/category', 'Admin\CategoryController');
        Route::resource('/good', 'Admin\GoodController');
        Route::resource('/member', 'Admin\MemberController');

        Route::post('uploadfile','Admin\SystemController@upload');
    });

});

