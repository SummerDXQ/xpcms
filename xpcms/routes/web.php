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
//Route::get('/admins/home/index','admins\Home@index')->middleware('rights');
//Route::get('/admins/site/index','admins\Site@index')->middleware(['auth','rights']);
//Route::get('/admins/home/index','admins\Home@index');
//Route::get('/admins/home/leftMenu','admins\Home@leftMenu');

Route::namespace('admins')->middleware(['auth','rights'])->group(function (){
    //xpcms home page
    Route::get('/admins/home/index','Home@index');
    Route::get('/admins/home/leftMenu','Home@leftMenu');
    Route::get('/admins/home/welcome','Home@welcome');
    //website setting
    Route::get('/admins/site/index','Site@index');
    //admin management
    Route::get('/admins/admin/index','Admin@index');
    Route::get('/admins/admin/add','Admin@add');
    Route::post('/admins/admin/save','Admin@save');
    Route::post('/admins/admin/edit','Admin@edit');
    Route::post('/admins/admin/edit_save','Admin@edit_save');
    Route::post('/admins/admin/del','Admin@del');
    //Menu management
    Route::get('/admins/menus/index','Menus@index');
    Route::post('/admins/menus/save','Menus@save');
    Route::post('/admins/menus/edit_save','Menus@edit_save');
    Route::post('/admins/menus/del','Menus@del');
    //Role management
    Route::get('/admins/groups/index','Groups@index');
    //Article management
    Route::get('/admins/content/index','Content@index');
});
