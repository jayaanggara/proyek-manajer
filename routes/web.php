<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\ProyekTypesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TemplateController;

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
    return view('auth.login');
})->middleware('guest');

// Login
Auth::routes();
Route::get('/api/notifications', [NotificationController::class, 'getNotif']);


Route::middleware('auth')->group(function() {
    // PROFILE/USERS
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('list-user');

    Route::get('/create-user', [App\Http\Controllers\UserController::class, 'create'])->name('create-user');

    Route::post('/proses-create-user', [App\Http\Controllers\UserController::class, 'store'])->name('proses-create-user');

    Route::get('/edit-user/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('edit-user');

    Route::post('/proses-edit-user/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('proses-edit-user');

    Route::get('/delete-user/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('delete-user');

    Route::post('user/update-status/{id}', [App\Http\Controllers\UserController::class, 'UpdateStatus'])->name('update-status-user');

    // Proyek
    Route::resource('proyek', ProyekController::class);

    // role
    Route::resource('roles', RoleController::class);
    Route::post('roles/update-status/{id}', [App\Http\Controllers\RoleController::class, 'UpdateStatus'])->name('roles.UpdateStatus');

    // proyek type
    Route::resource('proyek-type', ProyekTypesController::class);

    // Task list
    Route::post('task/update-status/{id}', [App\Http\Controllers\TaskController::class, 'UpdateStatus'])->name('task.UpdateStatus');
    Route::get('task/export', [App\Http\Controllers\TaskController::class, 'exportTask'])->name('task.export-task');
    Route::resource('task', TaskController::class);

    // template
    Route::resource('template', TemplateController::class);

    // reports
    Route::resource('reports', ReportsController::class);
    Route::post('reports/send/{id}', [App\Http\Controllers\ReportsController::class, 'sendEmail'])->name('reports.sendEmail');
});