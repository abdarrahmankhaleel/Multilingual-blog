<?php

use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostsController;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


//website

Route::get('/',[App\Http\Controllers\Website\IndexController::class ,'index'])->name('index');
Route::get('/post/{post}',[App\Http\Controllers\Website\PostController::class ,'show'])->name('post');
Route::get('/categories/{category}',[App\Http\Controllers\Website\CategoryController::class,'index'])->name('category');





//dashbord
// Route::get('/', function () {
//     return view('dashboard.index');
// });

// Route::prefix('dashboard')->group(function () {
//     Route::get('/settings', function () {
//         return view('dashboard.settings');
//     })->name('dashboard.settings');
// });
//'as' => alies name of route
//'middleware'=>'auth' دي ما بتخليكيش تفوت علي اي صفحة انتت حاططها بالقروب الا تايكون اثنتكيشن يعني عامل لوقن
Route::group(['prefix'=>'dashboard','as'=>'dashboard.','middleware'=>['auth','checkLogin']],function () {
    Route::get('/settings',[SettingsController::class ,'index'])->name('settings');

    Route::get('/', function () {
        return view('dashboard.layouts.layout');
    })->name('dashboard');

    Route::get('/index', function () {
        // return app()->getLocale();
        return config('app.locale');
    })->name('index');

    Route::post('/settings/update/{setting}', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('/users/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/users/all', [UserController::class, 'getUsersDataTable'])->name('users.all');



    Route::post('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/category/all', [CategoryController::class, 'getcategoryDatatable'])->name('category.all');


    Route::post('/posts/delete', [PostsController::class, 'delete'])->name('posts.delete');
    Route::get('/posts/all', [PostsController::class, 'getallposts'])->name('posts.all');

    Route::resources([
        'users' => UserController::class,
        'category' => CategoryController::class,
        'posts' => PostsController::class,


    ]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
