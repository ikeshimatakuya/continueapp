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


Route::controller(After_login_Controller::class)->prefix('home')->group(function(){
    Route::get('mypage','mypage');
    Route::get('past_action','past_history');
    Route::get('pie_chart','past_pie_chart');
    Route::get('various_setting','various_setting');
    Route::get('user_manual','user_manual');
    
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\After_login_Controller::class, 'index'])->name('home');
