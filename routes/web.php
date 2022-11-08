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
Route::post('/UserType/update', [App\Http\Controllers\UserTypeController::class, 'update'])->name('updateUserType');

Route::post('/Employer/create', [App\Http\Controllers\EmployerController::class, 'store'])->name('createEmployer');
Route::post('/Employer/update', [App\Http\Controllers\EmployerController::class, 'update'])->name('updateEmployer');

Route::post('/ProjectType/create', [App\Http\Controllers\ProjectTypeController::class, 'store'])->name('createProjectType');
Route::post('/ProjectType/update', [App\Http\Controllers\ProjectTypeController::class, 'update'])->name('updateProjectType');

Route::get('/UserDetails/create', [App\Http\Controllers\UserDetailController::class, 'create'])->name('createUserDetail');
Route::post('/UserDetails/create', [App\Http\Controllers\UserDetailController::class, 'store'])->name('storeUserDetail');

Route::post('/Company/create', [App\Http\Controllers\CompanyController::class, 'store'])->name('createCompany');
Route::get('/Company/{id}/Contact/create', [App\Http\Controllers\ContactController::class, 'create'])->name('createContact');
Route::post('/Company/{id}/Contact/create', [App\Http\Controllers\ContactController::class, 'store'])->name('storeContact');
Route::post('/Company/update', [App\Http\Controllers\CompanyController::class, 'update'])->name('updateCompany');
Route::get('/Company/Contact/{id}/update', [App\Http\Controllers\ContactController::class, 'edit'])->name('editContact');
Route::post('/Company/Contact/{id}/update', [App\Http\Controllers\ContactController::class, 'update'])->name('updateContact');

Route::get('/ProjectsDashboard/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('createProject');
Route::post('/ProjectsDashboard/create', [App\Http\Controllers\ProjectController::class, 'store'])->name('storeProject');
Route::get('/ProjectsDashboard/project/{id}', [App\Http\Controllers\ProjectController::class, 'show'])->name('showProject');
Route::post('/ProjectsDashboard/project/complete', [App\Http\Controllers\ProjectController::class, 'complete'])->name('completeProject');
Route::get('/ProjectsDashboard/project/{id}/edit', [App\Http\Controllers\ProjectController::class, 'edit'])->name('editProject');
Route::post('/ProjectsDashboard/project/{id}/edit', [App\Http\Controllers\ProjectController::class, 'update'])->name('updateProject');

Route::post('/ProjectsDashboard/project/linkContact', [App\Http\Controllers\ProjectContactController::class, 'store'])->name('linkContact');
Route::post('/ProjectsDashboard/project/addNote', [App\Http\Controllers\ProjectNoteController::class, 'store'])->name('addNote');

Route::post('/ProjectsDashboard/project/task/create', [App\Http\Controllers\TaskController::class, 'store'])->name('createTask');
Route::get('/ProjectsDashboard/project/task/{id}', [App\Http\Controllers\TaskController::class, 'show'])->name('showTask');
Route::get('/ProjectsDashboard/project/task/{id}/edit', [App\Http\Controllers\TaskController::class, 'edit'])->name('editTask');
Route::post('/ProjectsDashboard/project/task/{id}/edit', [App\Http\Controllers\TaskController::class, 'update'])->name('updateTask');
Route::post('/ProjectsDashboard/project/task/complete', [App\Http\Controllers\TaskController::class, 'complete'])->name('completeTask');

Route::post('/ProjectsDashboard/project/task/users', [App\Http\Controllers\TaskUserController::class, 'assignUser'])->name('assignUser');
Route::post('/ProjectsDashboard/project/task/note', [App\Http\Controllers\TaskNoteController::class, 'store'])->name('createTaskNote');

Route::post('/ProjectsDashboard/project/task/image', [App\Http\Controllers\TaskImageController::class, 'store'])->name('createTaskImage');
Route::post('/ProjectsDashboard/project/task/image/update', [App\Http\Controllers\TaskImageController::class, 'update'])->name('updateTaskImage');
Route::get('/ProjectsDashboard/project/task/image/{id}', [App\Http\Controllers\TaskImageController::class, 'download'])->name('downloadTaskImage');

Route::post('/ProjectsDashboard/project/task/file', [App\Http\Controllers\TaskFileController::class, 'store'])->name('createTaskFile');
Route::get('/ProjectsDashboard/project/task/file/{id}', [App\Http\Controllers\TaskFileController::class, 'download'])->name('downloadTaskFile');
Route::post('/ProjectsDashboard/project/task/file/update', [App\Http\Controllers\TaskFileController::class, 'update'])->name('updateTaskFile');
