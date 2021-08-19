<?php

use App\Http\Controllers\Store\StoreController;
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

Route::any('lista/filter', [StoreController::class, 'search']);
Route::get('lista', [StoreController::class, 'newIndex']);
Route::get('edit/{id}', [StoreController::class, 'show'])->name('edit.lista');
Route::get('lista2', [StoreController::class, 'newIndex'])->name('lista2');