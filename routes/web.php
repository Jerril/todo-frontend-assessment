<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/login-sql', [AuthController::class, 'login_form'])->name('sqllogin.get');
Route::post('/login-sql', [AuthController::class, 'login_post'])->name('sqllogin.post');
Route::get('/signup-sql', [AuthController::class, 'signup_form'])->name('sqlsignup.get');
Route::post('/signup-sql', [AuthController::class, 'signup_post'])->name('sqlsignup.post');

// Laravel Signup
Route::middleware('auth')->group(function() {
    Route::get('/sql-dashboard', fn() => view('sql-dashboard'))->name('sql.dashboard');
    Route::get('/sql-logout', [AuthController::class, 'sqlLogout'])->name('sql.logout');
});

// TODO Routes
Route::get('/dashboard', fn() => view('layouts.main'))->name('dashboard');
