<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

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

// Route::get('/', function () {
//     return view('file');
// });

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::resource('/', FileController::class);
    Route::post('store', [FileController::class, 'store']);
    Route::get('type', [FileController::class, 'type']);
    Route::get('date', [FileController::class, 'date']);
    Route::get('files', [FileController::class, 'file']);

    Route::post('search', [FileController::class, 'search']);
    Route::get('/search', [FileController::class, 'search'])->name('files');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::resource('category', CategoryController::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});