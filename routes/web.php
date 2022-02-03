<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\UserController;
use App\Http\Controllers\dashboard\DashboardController;
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

//login
Route::post('/login', [LoginController::class, 'login'])->name('login');
//logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//dashboard
Route::get('/home', [DashboardController::class, 'index'])->name('home');
//get all users
Route::get('/home/users', [UserController::class, 'index'])->name('users');
//create new user
Route::post('/home/users', [UserController::class, 'store'])->name('users.store');
//delete user
Route::delete('/home/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//update user
Route::patch('/home/users/{user}', [UserController::class, 'update'])->name('users.update');
//change user password
Route::patch('/home/users/{user}/password', [UserController::class, 'changePassword'])->name('users.password');
