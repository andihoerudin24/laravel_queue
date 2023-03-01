<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\Json2VideoController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dispatch/{batch_id?}',[IndexController::class,'index'])->name('dispatch');
Route::get('/dashboard/{batch_id?}',[IndexController::class,'dashboard'])->name('dashboard');
Route::get('/json2video/',[Json2VideoController::class,'index'])->name('json2video');
Route::get('/json2video60/',[Json2VideoController::class,'index60'])->name('json2video60');