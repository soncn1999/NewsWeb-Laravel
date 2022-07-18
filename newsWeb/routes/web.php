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

Route::get('/login', 'AdminController@loginAdmin')->name('admin.login');

Route::post('/login', 'AdminController@postLoginAdmin');

Route::prefix('admin')->group(function () {
    //Category
    Route::prefix('category')->group(function () {
        Route::get('/', [
            'as' => 'category.index',
            'uses' => 'CategoryController@index',
            'middleware' => 'can:category-list'
        ]);
        Route::get('/create', [
            'as' => 'category.create',
            'uses' => 'CategoryController@create',
            'middleware' => 'can:category-add'
        ]);
        Route::post('/store', [
            'as' => 'category.store',
            'uses' => 'CategoryController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'category.edit',
            'uses' => 'CategoryController@edit',
            'middleware' => 'can:category-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'category.update',
            'uses' => 'CategoryController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'category.delete',
            'uses' => 'CategoryController@delete',
            'middleware' => 'can:category-delete'
        ]);
    });
    //Menu
    Route::prefix('menu')->group(function () {
        Route::get('/', [
            'as' => 'menu.index',
            'uses' => 'MenuController@index',
            'middleware' => 'can:menu-list'
        ]);
        Route::get('/create', [
            'as' => 'menu.create',
            'uses' => 'MenuController@create',
            'middleware' => 'can:menu-add'
        ]);
        Route::post('/store', [
            'as' => 'menu.store',
            'uses' => 'MenuController@store'
        ]);

        Route::get('/edit/{id}', [
            'as' => 'menu.edit',
            'uses' => 'MenuController@edit',
            'middleware' => 'can:menu-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'menu.update',
            'uses' => 'MenuController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'menu.delete',
            'uses' => 'MenuController@delete',
            'middleware' => 'can:menu-delete'
        ]);
    });
    //Article
    Route::prefix('article')->group(function () {
        Route::get('/', [
            'as' => 'article.index',
            'uses' => 'AdminArticleController@index',
            'middleware' => 'can:article-list'
        ]);
        Route::get('/create', [
            'as' => 'article.create',
            'uses' => 'AdminArticleController@create',
            'middleware' => 'can:article-add'
        ]);
        Route::post('/store', [
            'as' => 'article.store',
            'uses' => 'AdminArticleController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'article.edit',
            'uses' => 'AdminArticleController@edit',
            'middleware' => 'can:article-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'article.update',
            'uses' => 'AdminArticleController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'article.delete',
            'uses' => 'AdminArticleController@delete',
            'middleware' => 'can:article-delete'
        ]);
        Route::get('/restore', [
            'as' => 'article.restore',
            'uses' => 'AdminArticleController@restore',
        ]);
        Route::get('/forceDelete/{id}', [
            'as' => 'article.forceDelete',
            'uses' => 'AdminArticleController@forceDelete',
        ]);
        Route::get('/restoreArticle/{id}', [
            'as' => 'article.restoreArticle',
            'uses' => 'AdminArticleController@restoreArticle',
        ]);
    });

    //User
    // Remove các comment 'middleware' ở đây
    Route::prefix('users')->group(function () {
        Route::get('/', [
            'as' => 'users.index',
            'uses' => 'AdminUserController@index',
            'middleware' => 'can:user-list'
        ]);
        Route::get('/create', [
            'as' => 'users.create',
            'uses' => 'AdminUserController@create',
            'middleware' => 'can:user-add'
        ]);
        Route::post('/store', [
            'as' => 'users.store',
            'uses' => 'AdminUserController@store'
        ]);
        Route::get('/edit/{id}', [
            'as' => 'users.edit',
            'uses' => 'AdminUserController@edit',
            'middleware' => 'can:user-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'users.update',
            'uses' => 'AdminUserController@update'
        ]);
        Route::get('/delete/{id}', [
            'as' => 'users.delete',
            'uses' => 'AdminUserController@delete',
            'middleware' => 'can:user-delete'
        ]);
    });
    // Remove các comment 'middleware' ở đây
    Route::prefix('roles')->group(function () {
        Route::get('/', [
            'as' => 'roles.index',
            'uses' => 'AdminRoleController@index',
            'middleware' => 'can:role-list'
        ]);
        Route::get('/create', [
            'as' => 'roles.create',
            'uses' => 'AdminRoleController@create',
            'middleware' => 'can:role-add'
        ]);
        Route::post('/store', [
            'as' => 'roles.store',
            'uses' => 'AdminRoleController@store'
        ]);
        Route::get('/edit/{id}}', [
            'as' => 'roles.edit',
            'uses' => 'AdminRoleController@edit',
            'middleware' => 'can:role-edit'
        ]);
        Route::post('/update/{id}', [
            'as' => 'roles.update',
            'uses' => 'AdminRoleController@update'
        ]);
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/create', [
            'as' => 'permissions.create',
            'uses' => 'AdminPermissionController@createPermissions'
        ]);
        Route::post('/store', [
            'as' => 'permissions.store',
            'uses' => 'AdminPermissionController@store'
        ]);
    });

});

