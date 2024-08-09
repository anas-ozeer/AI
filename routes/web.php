<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AIController;



Route::get('/', [AIController::class, 'view'])->name('dashboard');

Route::post('/', [AIController::class, 'generate'])->name('ai.generate');
