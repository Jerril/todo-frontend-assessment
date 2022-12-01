<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

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
})->name('index');

Route::get('/login-sql', [AuthController::class, 'sqllogin_form'])->name('sqllogin.get');
Route::post('/login-sql', [AuthController::class, 'sqllogin_post'])->name('sqllogin.post');
Route::get('/signup-sql', [AuthController::class, 'sqlsignup_form'])->name('sqlsignup.get');
Route::post('/signup-sql', [AuthController::class, 'sqlsignup_post'])->name('sqlsignup.post');

Route::middleware('auth')->group(function() {
    Route::get('/sql-dashboard', fn() => view('sql-dashboard'))->name('sql.dashboard');
    Route::get('/sql-logout', [AuthController::class, 'sqlLogout'])->name('sql.logout');
});


// Node Powered Endpoints
Route::get('/login', [AuthController::class, 'login_form'])->name('login.get');
Route::post('/login', [AuthController::class, 'login_post'])->name('login.post');
Route::get('/signup', [AuthController::class, 'signup_form'])->name('signup.get');
Route::post('/signup', [AuthController::class, 'signup_post'])->name('signup.post');

// Protected Routes
Route::middleware('loggedin')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Todo Routes
    Route::get('/dashboard', fn() => view('layouts.main'))->name('dashboard');
    Route::post('/todo', [TodoController::class, 'addTodo'])->name('todo.add');
    Route::put('/todo/{id}', [TodoController::class, 'updateTodo'])->name('todo.update');
    Route::delete('/todo/{id}', [TodoController::class, 'deleteTodo'])->name('todo.delete');
});
