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

Route::get('/', 'ArticleController@index')->name('home');

Route::get('/show/{id}', [
    'as' => 'articlecontroller.show',
    'uses' => 'ArticleController@getDetail'
]);

Route::get('/categoryshow/{id}', [
    'as' => 'categorycontroller.show',
    'uses' => 'CategoryController@show'
]);

Route::get('/tagshow/{id}', [
    'as' => 'tagcontroller.show',
    'uses' => 'TagController@show'
]);

Route::post('/load_comment', 'ArticleController@loadComment');

Route::post('/send_comment', 'ArticleController@sendComment');

Route::get('/delete_comment/{id}', 'ArticleController@deleteComment');

Route::post('/search_name', 'ArticleController@getSearch');

Route::get('/logout',function (){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('home');
})->name('logout');

Auth::routes();




