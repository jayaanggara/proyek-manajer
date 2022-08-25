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

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('list-user');

Route::get('/create-user', [App\Http\Controllers\UserController::class, 'create'])->name('create-user');

Route::post('/proses-create-user', [App\Http\Controllers\UserController::class, 'store'])->name('proses-create-user');

Route::get('/edit-user/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit-user');

Route::post('/proses-edit-user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('proses-edit-user');

Route::get('/delete-user/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('delete-user');