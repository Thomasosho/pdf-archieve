<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MultiFileUploadController;
use App\Http\Controllers\MoveController;
use App\Http\Controllers\UnitController;

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
    Route::get('/', [FileController::class, 'index']);
    Route::post('store', [FileController::class, 'store']);
    Route::get('type', [FileController::class, 'type']);
    Route::get('date', [FileController::class, 'date']);
    Route::get('files', [FileController::class, 'fil']);
    Route::resource('file', FileController::class);
    Route::get('download/{file}', [FileController::class, 'download']);
    // file actions
    Route::post('update/{id}', [FileController::class, 'update']);
    Route::get('show-file/{id}', [FileController::class, 'show']);
    Route::get('edit-file/{id}', [FileController::class, 'edit']);
    Route::get('delete/{id}', [FileController::class, 'delete']);

    Route::post('search', [FileController::class, 'search']);
    Route::get('/search', [FileController::class, 'search'])->name('files');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::resource('folder', CategoryController::class);

    Route::resource('unit', UnitController::class);

    Route::resource('move', MoveController::class);

    // multi uploads
    Route::resource('save', MultiFileUploadController::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});