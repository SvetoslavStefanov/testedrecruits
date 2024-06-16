<?php

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
Route::delete('task/{id}', [TaskController::class, 'destroy'])->name('delete-task');

Route::get('task/new', [TaskController::class, 'showAddTask'])->name('show-add-task');
Route::post('task/create', [TaskController::class, 'addTask'])->name('add-task');
Route::get('task/edit/{id}', [TaskController::class, 'showEditTask'])->name('edit-task');
Route::put('task/update/{id}', [TaskController::class, 'editTask'])->name('edit-tasks');

Route::get('/task/by-project/{id}', [TaskController::class, 'tasksByProject'])->name('tasks-by-project');
