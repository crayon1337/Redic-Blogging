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


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('/posts', 'PostsController');

Route::resource('/categories', 'CategoriesController');

Route::post('/addComment/{postId}', 'CommentsController@addComment')->name('addComment');

Route::get('/category/{id}', 'CategoriesController@getPostsbyCategory')->name('showPostsbyCategory');

Route::resource('/users', 'UsersController');

Route::post('/changeRole/{id}/{type}', 'UsersController@changeRole')->name('changeRole');
