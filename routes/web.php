<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;

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

Auth::routes(['verify' => true]);

Route::get('/', [HomeController::class, 'root'])->name('root');
Route::get('/yajra', [HomeController::class, 'yajra'])->name('yajra');
Route::get('/approval', [HomeController::class, 'approval'])->name('approval');

Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::get('/yajra-users', [UsersController::class, 'yajra'])->name('yajraUsers');

Route::get('{any}', [HomeController::class, 'index'])->name('index');