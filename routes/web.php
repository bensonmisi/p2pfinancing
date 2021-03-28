<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\welcomeController;



Route::get('/',[welcomeController::class,'index'])->name('welcome');



require __DIR__.'/auth.php';
require __DIR__.'/users.php';
require  __DIR__.'/admin.php';
