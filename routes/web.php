<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


Route::get('/dashboard/import', [HomeController::class, 'index'])->name('admin.import.form');
Route::post('/dashboard/import', [HomeController::class, 'importStudents'])->name('admin.import.students');
