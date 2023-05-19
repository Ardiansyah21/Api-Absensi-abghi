<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/absensi', [AbsensiController::class, 'index'])->name('index');
Route::post('absensi/store', [AbsensiController::class, 'store'])->name('store');
Route::get('/', [AbsensiController::class, 'createToken'])->name('createToken');
Route::get('absensi/{id}', [AbsensiController::class, 'show'])->name('show');
Route::patch('/absensi/update/{id}', [AbsensiController::class, 'update'])->name('update');
Route::delete('/absensi/delete/{id}', [AbsensiController::class, 'destroy'])->name('destroy');
Route::get('/absensi/show/trash/', [AbsensiController::class, 'trash'])->name('trash');
Route::get('/absensi/show/trash/{id}', [AbsensiController::class, 'restore'])->name('restore');
Route::get('/absensi/show/trash/permanent/{id}', [AbsensiController::class, 'permanenDelete'])->name('permanen Delete');


