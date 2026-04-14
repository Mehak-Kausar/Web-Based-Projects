<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordController;

Route::get('/', [PasswordController::class, 'index'])->name('home');
Route::post('/generate', [PasswordController::class, 'generate'])->name('generate');
Route::get('/show-passwords', [PasswordController::class, 'showAllPasswords'])->name('showPasswords'); // New route
Route::post('/deletePasswords', [PasswordController::class, 'deletePasswords'])->name('deletePasswords');
    