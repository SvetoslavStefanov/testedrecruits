<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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

Route::get('/', [TaskController::class, 'index'])->name('all-task');
Route::delete('task/{task}', [TaskController::class, 'destroy'])->name('delete-task');

Route::get('task/new', [TaskController::class, 'new'])->name('show-add-task');
Route::post('task/create', [TaskController::class, 'create'])->name('add-task');
Route::get('task/edit/{task}', [TaskController::class, 'edit'])->name('edit-task');
Route::put('task/update/{task}', [TaskController::class, 'update'])->name('update-task');

Route::get('/task/by-project/{project}', [TaskController::class, 'byProject'])->name('tasks-by-project');
Route::post('/task/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');

Route::resource('projects', ProjectController::class);