<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PostController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/post_list', [\App\Http\Controllers\PostController::class, 'index']);
Route::resource('/post', PostController::class);

Route::resource('/courses', CourseController::class)->except(['show']);

Route::get('courses/api-index', [CourseController::class, 'api'])->name('courses.api-index');
Route::get('courses/api-name', [CourseController::class, 'apiName'])->name('courses.api-name');

//Route::group(['prefix' => 'courses', 'as' => 'courses.'], function () {
//    Route::get('/create', [CourseController::class, 'create'])->name('create');
//    Route::post('/store', [CourseController::class, 'store'])->name('store');
//    Route::delete('/destroy/{course}', [CourseController::class, 'destroy'])->name('destroy');
//    Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
//});

Route::get('/test', function () {
    return view('layouts.master');
});
