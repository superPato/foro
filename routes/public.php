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
    'uses' => 'ShowPostController'
])->where('post', '[0-9]+');

Route::get('posts-pendientes/{category?}', [
    'uses' => 'ListPostController',
    'as' => 'posts.pending'
]);

Route::get('posts-completados/{category?}', [
    'uses' => 'ListPostController',
    'as' => 'posts.completed'
]);

Route::get('{category?}', [
    'uses' => 'ListPostController',
    'as' => 'posts.index'
]);