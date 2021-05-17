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



Route::get('/','webController@index');

/**
 * ショッピングカート機能
 * 購入した商品を表示させるルーティング
 */
Route::get('carts.index','CartController@index')->name('carts.index');

/**
 * カートに商品を追加するルーティング
 */
 Route::POST('users/carts','CartController@store')->name('carts.store');

/**
 * 購入するためのルーティング
 */
Route::delete('users/carts','CartController@destroy')->name('carts.destroy');

/**
 * ユーザー情報変更のルーティング
 */
Route::get('users/mypage', 'UserController@mypage')->name('mypage');
Route::get('users/mypage/edit', 'UserController@edit')->name('mypage.edit');
Route::get('users/mypage/address/edit', 'UserController@edit_address')->name('mypage.edit_address');
Route::put('users/mypage', 'UserController@update')->name('mypage.update');


/**
 * パスワード変更ようルーティング
 */

 Route::get('users/mypage/password/edit','UserController@edit_password')->name('mypage.edit_password');
 Route::put('users/mypage/password','UserController@update_password')->name('mypage.update_password');

//レビューの登録
Route::post('products/{product}/reviews','ReviewController@store');

//お気にり済かどうかテェックする  一緒にユーザーであるか確認をする
//お気に入りされていれば 「テェックを外す」
//お気に入りされていなければ追加する
Route::get('products/{product}/favorite','ProductController@favorite')->name('products.favorite');
//お気に入りに追加したものを表示させる
Route::get('users/mypage/favorite','UserController@favorite')->name('mypage.favorite');

//プロダクトコントローラーの呼び出し
Route::resource('products','ProductController');

Auth::routes([['verify' => true]]);

Route::get('/home', 'HomeController@index')->name('home');

if (env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}
