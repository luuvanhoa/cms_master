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
Route::group(['prefix' => 'administrator','middleware' => ['authadminRoute'] ], function () {//authadminRoute

    Route::get( '/', ['as' => 'home', 'uses' => 'Admin\DashBoardController@index'] );
    Route::get( 'dashboard', ['as' => 'dashboard', 'uses' => 'Admin\DashBoardController@index'] );

    // **** USER ****
    Route::get( 'user', ['as' => 'user-list', 'uses' => 'Admin\UserController@index'] );
    Route::get( 'user-add.html', ['as' => 'user-add', 'uses' => 'Admin\UserController@formUser'] );
    Route::post('user-add.html', ['as' => 'user-add-post', 'uses' => 'Admin\UserController@addUser'] );
    Route::get( 'user-edit-{id}.html', ['as' => 'user-edit', 'uses' => 'Admin\UserController@editUser'] );
    Route::post('user-edit-{id}.html', ['as' => 'user-edit-post', 'uses' => 'Admin\UserController@storeUser'] );
    Route::get( 'user-del-{id}.html', ['as' => 'user-del', 'uses' => 'Admin\UserController@delUser'] );
    // **** USER ****

    // **** STUDENT ****
    Route::get( 'student', ['as' => 'student-list', 'uses' => 'Admin\StudentController@index'] );
    Route::get( 'student-add-{id}.html', ['as' => 'student-add', 'uses' => 'Admin\StudentController@formStudent'] );
    Route::post('student-add-{id}.html', ['as' => 'student-add-post', 'uses' => 'Admin\StudentController@addStudent'] );
    Route::get( 'student-edit-{id}.html', ['as' => 'student-edit', 'uses' => 'Admin\StudentController@editStudent'] );
    Route::post('student-edit-{id}.html', ['as' => 'student-edit-post', 'uses' => 'Admin\StudentController@storeStudent'] );
    Route::get( 'student-del-{id}.html', ['as' => 'student-del', 'uses' => 'Admin\StudentController@delStudent'] );
    // **** STUDENT ****

    // **** CATEGORY COURSE ****
    Route::get( 'category-course', ['as' => 'category-course-list', 'uses' => 'Admin\CategoryCourseController@index'] );
    Route::get( 'category-course-add.html', ['as' => 'category-course-add', 'uses' => 'Admin\CategoryCourseController@formCategoryCourse'] );
    Route::post('category-course-add.html', ['as' => 'category-course-add-post', 'uses' => 'Admin\CategoryCourseController@addCategoryCourse'] );
    Route::get( 'category-course-edit-{id}.html', ['as' => 'category-course-edit', 'uses' => 'Admin\CategoryCourseController@editCategoryCourse'] );
    Route::post('category-course-edit-{id}.html', ['as' => 'category-course-edit-post', 'uses' => 'Admin\CategoryCourseController@storeCategoryCourse'] );
    Route::get( 'category-course-del-{id}.html', ['as' => 'category-course-del', 'uses' => 'Admin\CategoryCourseController@delCategoryCourse'] );
    // **** CATEGORY COURSE ****

    // **** COURSE ****
    Route::get( 'course', ['as' => 'course-list', 'uses' => 'Admin\CourseController@index'] );
    Route::get( 'course-add.html', ['as' => 'course-add', 'uses' => 'Admin\CourseController@formCourses'] );
    Route::post('course-add.html', ['as' => 'course-add-post', 'uses' => 'Admin\CourseController@addCourses'] );
    Route::get( 'course-edit-{id}.html', ['as' => 'course-edit', 'uses' => 'Admin\CourseController@editCourses'] );
    Route::post('course-edit-{id}.html', ['as' => 'course-edit-post', 'uses' => 'Admin\CourseController@storeCourses'] );
    Route::get( 'course-del-{id}.html', ['as' => 'course-del', 'uses' => 'Admin\CourseController@delCourses'] );
    // **** COURSE ****

    // **** CATEGORIES ARTICLE ****
    Route::get( 'article-category', ['as' => 'article-category', 'uses' => 'Admin\CategoryArticleController@articleIndex'] );
    Route::get( 'article-category-add.html', ['as' => 'article-category-add', 'uses' => 'Admin\CategoryArticleController@articleAdd'] );
    Route::post( 'article-category-add.html', ['as' => 'article-category-add', 'uses' => 'Admin\CategoryArticleController@articlePost'] );
    Route::get( 'article-category-edit-{id}.html', ['as' => 'article-category-edit', 'uses' => 'Admin\CategoryArticleController@articleEdit'] );
    Route::post( 'article-category-edit-{id}.html', ['as' => 'article-category-edit', 'uses' => 'Admin\CategoryArticleController@articleStore'] );
    Route::get( 'article-category-del-{id}.html', ['as' => 'article-category-del', 'uses' => 'Admin\CategoryArticleController@articleDel'] );
    Route::post( 'article-category/change-status', ['as'=>'article-category-status', 'uses'=> 'Admin\CategoryArticleController@articleChangeStatus'] );
    // **** CATEGORIES ARTICLE ****

});
