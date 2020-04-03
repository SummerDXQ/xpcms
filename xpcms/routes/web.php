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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/admins/login', 'admins\Account@login')->name('login');
Route::get('/admins/account/captcha', 'admins\Account@captcha');
Route::post('/admins/account/doLogin','admins\Account@doLogin');
//Route::get('/admins/home/index','admins\Home@index')->middleware(['auth','rights']);
Route::get('/admins/home/index','admins\Home@index')->middleware('rights');
//Route::get('/admins/home/index','admins\Home@index');
//Route::get('/admins/home/leftMenu','admins\Home@leftMenu');
