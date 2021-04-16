<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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

Route::get('/',[HomeController::class,"home"]);

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login',[UserController::class,"login"]);
Route::post('/login',[UserController::class,"login_post"]);
Route::get('/register',[UserController::class,"register"]);
Route::post('/register',[UserController::class,"register_post"]);
Route::post('/logout',[UserController::class,"logout"]);

// E-mail Verification 
Route::get('/account/verification/{token}',[UserController::class,"account_verification"]);
Route::get('/two_factor_verify',[UserController::class,"two_factor_code_check"]);
Route::post('/two_factor_verify',[UserController::class,"two_factor_code_check_post"]);

