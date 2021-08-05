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

Route::get('/', 'BlogController@index')->name('index');
Route::get('login','UserController@login')->name('login');
Route::get('logout','UserController@logout')->name('logout');
Route::get('register','UserController@register')->name('register');
Route::post('save-user','UserController@saveUser')->name('save-user');
Route::post('authenticate','UserController@authenticate')->name('authenticate');
Route::get('add-blog','BlogController@addBlog')->name('add-blog');
Route::get('edit-blog/{id}','BlogController@addBlog')->name('edit-blog');
Route::get('delete-blog/{id}','BlogController@deleteBlog')->name('delete-blog');
Route::post('save-blog','BlogController@saveBlog')->name('save-blog');