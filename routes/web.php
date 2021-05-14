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

use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});


//レビューの登録
Route::post('products/{product}/reviews','ReviewController@store');

//お気にり済かどうかテェックする  一緒にユーザーであるか確認をする
//お気に入りされていれば 「テェックを外す」
//お気に入りされていなければ追加する
Route::get('products/{product}/favorite','ProductController@favorite')->name('products.favorite');

//プロダクトコントローラーの呼び出し
Route::resource('products','ProductController');

Auth::routes([['verify' => true]]);

Route::get('/home', 'HomeController@index')->name('home');


