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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Admin', [App\Http\Controllers\HomeController::class, 'admin']);
Route::get('/ProjectsDashboard', [App\Http\Controllers\ProjectController::class, 'index']);
Route::get('/ContactBook', [App\Http\Controllers\ContactController::class, 'index']);

Route::post('/UserType/create', [App\Http\Controllers\UserTypeController::class, 'store'])->name('createUserType');
Route::post('/Employer/create', [App\Http\Controllers\EmployerController::class, 'store'])->name('createEmployer');
