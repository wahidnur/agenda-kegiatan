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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/tambah', [HomeController::class, 'tambah'])->name('tambah');
Route::post('/simpan', [HomeController::class, 'simpan'])->name('simpan');
