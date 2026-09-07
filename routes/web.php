<?php

use App\Http\Controllers\SavingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SavingController::class, 'index'])->name('savings.index');
Route::post('/savings', [SavingController::class, 'store'])->name('savings.store');
Route::patch('/savings/{saving}', [SavingController::class, 'update'])->name('savings.update');
Route::delete('/savings/{saving}', [SavingController::class, 'destroy'])->name('savings.destroy');

