<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\FinishUserRegisterController;
use App\Http\Controllers\User\TrainingController;
use App\Http\Controllers\User\MypageController;
use App\Http\Controllers\User\PastActionController;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\User\ManualController;

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


Route::controller(FinishUserRegisterController::class)->prefix('auth')->name('auth.')->middleware('auth')->group(function(){
    Route::get('finish_user_register','finish_user_register')->name('finish_user_register');
    Route::post('finish_user_register','finish_user_register')->name('finish_user_register');
});

Route::controller(TrainingController::class)->prefix('training_register')->middleware('auth')->group(function(){
    Route::get('training_aim_register','create')->name('training_aim_register');
    Route::post('finish_training_aim_register','createTrainingAim')->name('finish_training_aim_register');
});

Route::controller(TrainingController::class)->prefix('home')->name('home.')->middleware('auth')->group(function(){
   Route::get('mypage','mypage')->name('mypage'); 
});


/*
Route::controller(MypageController::class)->prefix('home')->name('home.')->middleware('auth')->group(function(){
    Route::get('mypage','mypage')->name('mypage');
    Route::post('mypage','mypage')->name('mypage');
});
*/

Route::controller(PastActionController::class)->prefix('home')->name('home.')->middleware('auth')->group(function(){
    Route::get('past_history','past_history')->name('past_history');
    Route::get('past_pie_chart','past_pie_chart')->name('past_pie_chart');
});

Route::controller(SettingController::class)->prefix('home')->name('home.')->middleware('auth')->group(function(){
    Route::get('user_setting','setting')->name('setting');
});

Route::controller(ManualController::class)->prefix('home')->name('home.')->middleware('auth')->group(function(){
    Route::get('user_manual','user_manual')->name('user_manual');
});


Auth::routes();


