<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\MainHomeController::class, 'welcome'])->name('welcome');
Route::get('/catalog', [App\Http\Controllers\MainHomeController::class, 'catalog'])->name('catalog');
Route::get('/about', [App\Http\Controllers\MainHomeController::class, 'about'])->name('about');
Route::get('/where', [App\Http\Controllers\MainHomeController::class, 'where'])->name('where');
Route::get('/product/{id}', [App\Http\Controllers\MainHomeController::class, 'product'])->name('product');
Route::get('/panel', [App\Http\Controllers\MainHomeController::class, 'panel'])->name('panel');
Route::post('/del-product', [App\Http\Controllers\MainHomeController::class, 'del'])->name('del');
Route::post('/red-product', [App\Http\Controllers\MainHomeController::class, 'redact'])->name('redact');
Route::post('/add_img', [App\Http\Controllers\MainHomeController::class, 'add_img'])->name('add_img');
Route::get('/review/{id}', [App\Http\Controllers\MainHomeController::class, 'review'])->name('review');
Route::post('/add_comment', [App\Http\Controllers\MainHomeController::class, 'add_comment'])->name('add_comment')->middleware('auth');
Route::post('/edit_comment', [App\Http\Controllers\MainHomeController::class, 'edit_comment'])->name('edit_comment')->middleware('auth');
Route::get('/profile', [App\Http\Controllers\MainHomeController::class, 'profile'])->name('profile')->middleware('auth');
Route::post('/profile/update', [App\Http\Controllers\MainHomeController::class, 'profile_update'])->name('profile_update')->middleware('auth');
Route::get('/top', [App\Http\Controllers\MainHomeController::class, 'top'])->name('top');
Route::post('/delete_comment', [App\Http\Controllers\MainHomeController::class, 'delete_comment'])->name('delete_comment')->middleware('auth');
Route::get('/panel/edit/{id}', [App\Http\Controllers\MainHomeController::class, 'edit'])->name('edit');
Route::post('/panel/update/{id}', [App\Http\Controllers\MainHomeController::class, 'update'])->name('update');