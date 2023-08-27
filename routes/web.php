<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('guest');
Route::get('/download/{id}', [DashboardController::class, 'download'])->name('download')->middleware('guest');

Auth::routes();

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('simpan', [HomeController::class, 'simpan'])->name('simpan');
    Route::get('edit/{id}', [HomeController::class, 'edit'])->name('edit');
    Route::post('update/{id}', [HomeController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [HomeController::class, 'delete'])->name('delete');
});
