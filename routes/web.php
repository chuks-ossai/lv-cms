<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'FrontController@index')->name('welcome');
Route::get('post/{post}', 'FrontController@single')->name('post.single');
Route::get('category/{category}', 'FrontController@category')->name('category.single');
Route::get('tag/{tag}', 'FrontController@tag')->name('tag.single');

Route::post('/comments/{post}', 'CommentsController@create')->name('comments.create');

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('categories', 'CategoriesController');

    Route::resource('tags', 'TagsController');

    Route::resource('posts', 'PostsController');

    Route::get('/trashed-posts', 'PostsController@trashed')->name('trashed.posts');

    Route::put('/restore/{post}', 'PostsController@retrieve')->name('retrieve.post');

    Route::get('/users', 'UserController@index')->name('users.index');
    Route::put('/users/{user}', 'UserController@makeAdmin')->name('users.makeAdmin');

    Route::get('/users/profile', 'UserController@profile')->name('users.profile');
    Route::put('/users', 'UserController@updateProfile')->name('users.update');

});

Route::middleware(['auth', 'verifyAdmin'])->group(function () {
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::put('/users/{user}', 'UserController@makeAdmin');
});
