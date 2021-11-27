<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;

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

Route::resource('/', FileController::class);
Route::post('store', [FileController::class, 'store']);
Route::get('type', [FileController::class, 'type']);
Route::get('date', [FileController::class, 'date']);

Route::post('search', [FileController::class, 'search']);
Route::get('/search', [FileController::class, 'search'])->name('files');