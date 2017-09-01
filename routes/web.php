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
Route::any('/vertiy',"vertiy\serverController@vertiy");
Route::any('/wechat','WechatController@serve');
Route::any('/menu_add','WechatController@menu_add');

Route::group(['middleware' => ['web', 'wechat.oauth']],function(){
    Route::get("/enroll", function (){
        return view('sign');
//        $user = session('wechat.oauth_user'); // 拿到授权用户资料
//        dd($user);
    });
});
Route::post('/sign','WechatController@sign');