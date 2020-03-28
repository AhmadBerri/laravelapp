<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index');


Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'AdminController@index');

    Route::resource('/admin/users', 'AdminUsersController', ['names' => [
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'edit' => 'admin.users.edit',
        'store' => 'admin.users.store'
    ]]);

    Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'HomeController@post']);

    Route::resource('/admin/posts', 'AdminPostsController', ['names' => [
        'index' => 'admin.posts.index',
        'create' => 'admin.posts.create',
        'store' => 'admin.posts.store',
        'edit' => 'admin.posts.edit'
    ]]);

    Route::resource('/admin/categories', 'AdminCategoriesController', ['names' => [
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit'
    ]]);

    Route::resource('/admin/media', 'AdminMediaController', ['names' => [
        'index' => 'admin.media.index',
        'create' => 'admin.media.create',
        'store' => 'admin.media.store',
        'edit' => 'admin.media.edit'
    ]]);

    Route::delete('admin/delete/media', 'AdminMediaController@deleteMedia');

    Route::resource('/admin/comments', 'PostCommentsController', ['names' => [
        'index' => 'admin.comments.index',
        'create' => 'admin.comments.create',
        'edit' => 'admin.comments.edit',
        'store' => 'admin.comments.store',
        'show' => 'admin.comments.show'
    ]]);

    Route::resource('/admin/comments/replies', 'CommentRepliesController', ['names' => [
        'index' => 'admin.comments.replies.index',
        'create' => 'admin.comments.replies.create',
        'edit' => 'admin.comments.replies.edit',
        'store' => 'admin.comments.replies.store',
        'show' => 'admin.comments.replies.show'
    ]]);
});
