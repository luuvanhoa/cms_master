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

//Route::get( '/', ['as' => 'site', 'uses' => 'Fronts\IndexController@index'] );

Route::group(['prefix' => 'administrator', 'middleware' => ['web']], function () {
    Route::get( 'login', ['as' => 'login', 'uses' => 'Admin\UserController@login'] );
    Route::post( 'login', ['as' => 'login_post', 'uses' => 'Admin\UserController@loginPost'] );
    Route::get( 'logout', ['as' => 'logout', 'uses' => 'Admin\UserController@logOut'] );
    Route::get( 'register', ['as' => 'register', 'uses' => 'Admin\UserController@register'] );
});

// ADMIN
Route::group(['prefix' => 'admin-site','middleware' => ['authadminRoute'] ], function () {//authadminRoute

    Route::get( '/', ['as' => 'home', 'uses' => 'Admin\DashBoardController@index'] );
    Route::get( 'dashboard', ['as' => 'dashboard', 'uses' => 'Admin\DashBoardController@index'] );

    // **** USER ****
    Route::get( 'user', ['as' => 'user-list', 'uses' => 'Admin\UserController@index'] );
    Route::get( 'user/add', ['as' => 'user-add', 'uses' => 'Admin\UserController@formUser'] );
    Route::post( 'user/add', ['as' => 'user-add-post', 'uses' => 'Admin\UserController@addUser'] );
    Route::get( 'user/edit/{id}', ['as' => 'user-edit', 'uses' => 'Admin\UserController@editUser'] );
    Route::post( 'user/edit/{id}', ['as' => 'user-edit-post', 'uses' => 'Admin\UserController@storeUser'] );
    Route::get( 'user/del/{id}', ['as' => 'user-del', 'uses' => 'Admin\UserController@delUser'] );
    // **** USER ****

    // **** CATEGORIES ARTICLE ****
    Route::get( 'article-category', ['as' => 'article-category', 'uses' => 'Admin\CategoryArticleController@articleIndex'] );
    Route::get( 'article-category-add.html', ['as' => 'article-category-add', 'uses' => 'Admin\CategoryArticleController@articleAdd'] );
    Route::post( 'article-category-add.html', ['as' => 'article-category-add', 'uses' => 'Admin\CategoryArticleController@articlePost'] );
    Route::get( 'article-category-edit-{id}.html', ['as' => 'article-category-edit', 'uses' => 'Admin\CategoryArticleController@articleEdit'] );
    Route::post( 'article-category-edit-{id}.html', ['as' => 'article-category-edit', 'uses' => 'Admin\CategoryArticleController@articleStore'] );
    Route::get( 'article-category-del-{id}.html', ['as' => 'article-category-del', 'uses' => 'Admin\CategoryArticleController@articleDel'] );
    Route::post( 'article-category/change-status', ['as'=>'article-category-status', 'uses'=> 'Admin\CategoryArticleController@articleChangeStatus'] );
    // **** CATEGORIES ARTICLE ****

    // **** CATEGORIES PRODUCT ****
    Route::get( 'product-category', ['as' => 'product-category', 'uses' => 'Admin\CategoryProductController@productIndex'] );
    Route::get( 'product-category-add.html', ['as' => 'product-category-add', 'uses' => 'Admin\CategoryProductController@productAdd'] );
    Route::post( 'product-category-add.html', ['as' => 'product-category-add', 'uses' => 'Admin\CategoryProductController@productPost'] );
    Route::get( 'product-category-edit-{id}.html', ['as' => 'product-category-edit', 'uses' => 'Admin\CategoryProductController@productEdit'] );
    Route::post( 'product-category-edit-{id}.html', ['as' => 'product-category-edit', 'uses' => 'Admin\CategoryProductController@productStore'] );
    Route::get( 'product-category-del-{id}.html', ['as' => 'product-category-del', 'uses' => 'Admin\CategoryProductController@productDelete'] );
    Route::post( 'product-category/change-status', ['as'=>'product-category-status', 'uses'=> 'Admin\CategoryProductController@productChangeStatus'] );
    // **** CATEGORIES PRODUCT ****

});
