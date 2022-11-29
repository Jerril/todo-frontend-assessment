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
    return redirect('/login');
});

Route::get('/login', fn() => view('login'))->name('login.get');

Route::post('/login', fn() => "POST login")->name('login.post');;

Route::get('/signup', fn() => view('signup'))->name('signup.get');

Route::post('/signup', fn() => "POST signup")->name('signup.post');


// TODO Routes
