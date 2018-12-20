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

Route::get('/home', 'HomeController@index');

Route::get('posts/{post}-{slug}', [
    'as' => 'posts.show',
    'uses' => 'PostController@show'
])->where('post', '[0-9]+');

Route::get('posts-pendientes', [
    'uses' => 'PostController@index',
    'as' => 'posts.pending'
]);

Route::get('posts-completados', [
    'uses' => 'PostController@index',
    'as' => 'posts.completed'
]);

Route::get('{category?}', [
    'uses' => 'PostController@index',
    'as' => 'posts.index'
]);