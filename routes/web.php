<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\SettingsController;

use App\Http\Middleware\IsLoginAuthor;

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
//Route::get('/{page}',[HomeController::class,"page"]);
Route::get("/contact", [HomeController::class,"contact"]);
Route::post("/contact", [HomeController::class,"contactPost"]);

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


Route::prefix("account")->group(function(){

    // E-mail Verification User
    Route::get('/verification/{token}',[UserController::class,"account_verification"]);
    Route::get('/two_factor_verify',[UserController::class,"two_factor_code_check"]);
    Route::post('/two_factor_verify',[UserController::class,"two_factor_code_check_post"]);
    Route::get("/test",function (){
        return "merhaba";
    })->middleware("IsLoginUser");
    //Route::get('/settings',[UserController::class,"account_settings"]);
    //Route::post('/settings',[UserController::class,"account_settings"]);
});

/*
|--------------------------------------------------------------------------
| Author Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('author/login',[AuthorController::class,"login"]);
Route::post('author/login',[AuthorController::class,"login_post"]);

Route::prefix("author")->middleware("IsLoginAuthor")->group(function(){

    // About Author Account
    Route::get('/verification/{token}',[AuthorController::class,"account_verification"]);
    Route::get('/two_factor_verify',[AuthorController::class,"two_factor_code_check"]);
    Route::post('/two_factor_verify',[AuthorController::class,"two_factor_code_check_post"]);
    Route::get('/dashboard',[AuthorController::class,"dashboard"]);
    Route::post('/logout',[AuthorController::class,"logout"]);

    //Route::get('/settings',[UserController::class,"account_settings"]);
    //Route::post('/settings',[UserController::class,"account_settings"]);

    // Articles Route
    Route::get("/articles", [ArticlesController::class,"articles"]);
    Route::get("/articles/create", [ArticlesController::class,"articlesCreate"]);
    Route::post("/articles/create", [ArticlesController::class,"articlesCreatePost"]);
    Route::post("/articles/delete",[ArticlesController::class,"articlesDelete"]);
    Route::get("/articles/edit/status",[ArticlesController::class,"articlesEditStatus"]);
    Route::get("/articles/edit/{id}",[ArticlesController::class,"articlesEdit"]);
    Route::put("/articles/edit/{id}",[ArticlesController::class,"articlesEditPost"]);

    // Categories Route
    Route::get("/categories",[CategoryController::class,"categories"]);
    Route::post("/categories/create",[CategoryController::class,"categoriesCreate"]);
    Route::post("/categories/delete",[CategoryController::class,"categoriesDelete"]);
    Route::get("/categories/edit",[CategoryController::class,"categoriesEdit"]);
    Route::post("/categories/edit/{id}",[CategoryController::class,"categoriesEditPost"]);
    Route::get("/categories/edit/status",[CategoryController::class,"categoriesEditStatus"]);

});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin/login',[AdminController::class,"login"]);
Route::post('admin/login',[AdminController::class,"login_post"]);

Route::prefix("admin")->middleware("IsLoginAdmin")->group(function(){

    // E-mail Verification Author
    Route::get('/verification/{token}',[AdminController::class,"account_verification"]);
    Route::get('/two_factor_verify',[AdminController::class,"two_factor_code_check"]);
    Route::post('/two_factor_verify',[AdminController::class,"two_factor_code_check_post"]);
    Route::get('/dashboard',[AdminController::class,"dashboard"]);
    Route::post('/logout',[AdminController::class,"logout"]);
    // Account Settings
    //Route::get('/settings',[UserController::class,"account_settings"]);
    //Route::post('/settings',[UserController::class,"account_settings"]);

    // Articles Route
    Route::get("/articles", [BlogController::class,"articles"]);

    // Categories Route
    Route::get("/categories",[BlogController::class,"categories"]);

    //Author Route
    Route::get("/authors",[AdminController::class,"authors"]);
    Route::get("/authors/create",[AdminController::class,"authorsCreate"]);
    Route::post("/authors/create",[AdminController::class,"authorsCreatePost"]);
    Route::post("/authors/delete",[AdminController::class,"authorsDelete"]);

    // Announcements Route
    Route::get("/announcements",[AdminController::class,"announcements"]);
    Route::get("/announcements/create",[AdminController::class,"announcementsCreate"]);
    Route::post("/announcements/create",[AdminController::class,"announcementsCreatePost"]);

    //Site Settings
    Route::get("/site/settings",[SettingsController::class,"index"]);

    // Page Route
    Route::get("/pages", [PageController::class,"pages"]);



});


