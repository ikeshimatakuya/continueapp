<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\After_login_Controller;
use App\Http\Controllers\User\Before_login_Controller;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(Before_login_Controller::class)->prefix('auth')->name('auth.')->middleware('auth')->group(function(){
    Route::get('finish_user_register','finish_user_register')->name('finish_user_register');
    Route::post('finish_user_register','finish_user_register')->name('finish_user_register');
    Route::get('action_register','action_register')->name('action_register');
    Route::get('finish_action_register','finish_action_register')->name('finish_action_register');
});

// Route::routes(get('/home', [App\Http\Controllers\User\before_login_Controller::class, ''])->('register');


Route::controller(After_login_Controller::class)->prefix('home')->name('home.')->middleware('auth')->group(function(){
    Route::get('mypage','mypage')->name('mypage');
    Route::post('mypage','mypage')->name('mypage');
    Route::get('past_action','past_history')->name('past_history');
    Route::get('pie_chart','past_pie_chart')->name('pie_chart');
    Route::get('various_setting','various_setting')->name('various_setting');
    Route::get('user_manual','user_manual')->name('user_manual');
    
});

Auth::routes();


