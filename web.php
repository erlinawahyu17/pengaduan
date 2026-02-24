<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\ResponseController;


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('postLogin');


Route::middleware(['auth'])->group(function (){
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('aspirasi', AspirasiController::class);
    Route::post('/aspirasi/{aspirasi}/responses', [ResponseController::class, 'store'])->name('response.store');
    Route::middleware(['CekRole:admin'])->group(function (){
    Route::resource('siswa', SiswaController::class);
    Route::post('/aspirasi{aspirasi}/update-status', [AspirasiController::class, 'updateStatus'])->name('aspirasi.updateStatus');
    });
    Route::get('aspirasi/create', [AspirasiController::class, 'create'])
    ->name('aspirasi.create');
    Route::post('aspirasi', [AspirasiController::class, 'store'])
    ->name('aspirasi.store');

});

Route::get('/', function () {
    return view('welcome');
});
