<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterTutorialController;
use App\Http\Controllers\DetailTutorialController;

Route::get('/',       fn() => redirect('/login'));
Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('token.auth')->group(function () {
    Route::resource('tutorials', MasterTutorialController::class);
    Route::resource('tutorials.details', DetailTutorialController::class);
    Route::resource('tutorials.details', DetailTutorialController::class);
});

