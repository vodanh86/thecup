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
Route::get('/category/{slug}', 'CategoryController@view');
Route::get('/page/{slug}', 'PageController@view');
Route::get('/site/contact', 'PageController@contact');
Route::get('/site/search', 'PageController@search');
Route::get('/user/profile', 'UserController@profile');
Route::get('/episode/{slug}', 'EpisodeController@view');
Route::get('/author/{slug}', 'AuthorController@view');
Route::get('/user/subscribe', 'UserController@subscribe')->middleware('auth');
Route::post('/user/update', 'UserController@update');
Route::get('/user/purchase', 'UserController@purchase');
Route::post('/user/updateAvatar', 'UserController@updateAvatar');
Route::get('/payment/createPayment', 'PaymentController@createPayment');
Route::get('/payment/vnpayReturn', 'PaymentController@vnpayReturn');
Route::get('/payment/vnpayResult', 'PaymentController@vnpayResult');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');