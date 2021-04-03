<?php

use App\Http\Controllers\subscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\welcomeController;
use Inertia\Inertia;

Route::get('/',[welcomeController::class,'index'])->name('welcome');
Route::get('/investing',[welcomeController::class,'investors'])->name('investing');
Route::get('/borrowing',[welcomeController::class,'borrowing'])->name('borrowing');
Route::get('/about',function(){  return Inertia::render('front/about');})->name('about');
Route::resource('/subscription',subscriptionController::class);




require __DIR__.'/auth.php';
require __DIR__.'/users.php';
require  __DIR__.'/admin.php';
