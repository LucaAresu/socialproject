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

Route::get('/', 'PostController@index')->name('index');;
Route::get('post','PostController@index')->name('post_index');
Auth::routes();

Route::get('post/{post}', 'PostController@show')->name('single_post')->where('post', '[0-9]+');
Route::get('post','PostController@index');

Route::middleware('auth')->group(function() {
    Route::get('post/create','PostController@create')->name('create_post');
    Route::post('post/create', 'PostController@store');
    Route::get('post/{post}/edit', 'PostController@edit')->name('edit_post');
    Route::post('post/{post}/edit','PostController@update');

    Route::delete('post/{post}', 'PostController@destroy')->name('destroy_post');

    Route::post('post/{post}', 'CommentController@store');

    Route::get('user/{user}/settings','userController@impostazioni')->name('user_settings');
});
Route::get('user/{user}','PostController@userPost')->name('user_post');

//impostazioni
Route::middleware('auth')->group(function() {

    Route::get('user/{user}/settings','userController@impostazioni')->name('user_settings');
    Route::post('user/{user}/settings','userController@cambioAvatar')->name('change_avatar');
});
