<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BodyMakerController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\PicController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ChassisController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\IdentityController;
use App\Http\Controllers\NewsController;
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

Route::get('/body-maker', [BodyMakerController::class, 'index'])->name('body-maker');
Route::get('/body-maker-show', [BodyMakerController::class, 'show'])->name('show');
Route::post('/body-maker', [BodyMakerController::class, 'create'])->name('create');

Route::get('/body-maker-identity', [IdentityController::class, 'index'])->name('index');
Route::post('/body-maker-identity', [IdentityController::class, 'create'])->name('create');

Route::get('/body-maker-design', [DesignController::class, 'index'])->name('index');
Route::post('/body-maker-design', [DesignController::class, 'create'])->name('create');

Route::get('/body-maker-equipment', [EquipmentController::class, 'index'])->name('index');
Route::post('/body-maker-equipment', [EquipmentController::class, 'create'])->name('create');

Route::get('/body-maker-pic', [PicController::class, 'index'])->name('index');
Route::post('/body-maker-pic', [PicController::class, 'create'])->name('create');

Route::get('/body-maker-production', [ProductionController::class, 'index'])->name('index');
Route::post('/body-maker-production', [ProductionController::class, 'create'])->name('create');

Route::get('/body-maker-chassis', [ChassisController::class, 'index'])->name('index');
Route::post('/body-maker-chassis', [ChassisController::class, 'create'])->name('create');

Route::get('/body-maker-variant', [VariantController::class, 'index'])->name('index');
Route::post('/body-maker-variant', [VariantController::class, 'create'])->name('create');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'get'])->name('get');
Route::get('/yajra-news', [NewsController::class, 'yajra'])->name('yajraNews');
Route::post('/news', [NewsController::class, 'create'])->name('create');
Route::post('/news-update', [NewsController::class, 'updateNews'])->name('updateNews');
Route::delete('/news/{user}', [NewsController::class, 'delete'])->name('delete');

Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::get('/yajra-users', [UsersController::class, 'yajra'])->name('yajraUsers');
Route::post('/users', [UsersController::class, 'create'])->name('create');
Route::put('/users/{user}', [UsersController::class, 'update'])->name('update');
Route::delete('/users/{user}', [UsersController::class, 'delete'])->name('delete');

Route::get('{any}', [HomeController::class, 'index'])->name('index');