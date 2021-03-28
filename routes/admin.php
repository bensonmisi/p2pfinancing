<?php
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth']],function(){
    Route::group(['prefix'=>'dashboard'],function(){
        Route::resource('/awaiting-loans',App\Http\Controllers\administrator\loans\awaitingController::class);
        Route::resource('/approved-loans',App\Http\Controllers\administrator\loans\approvedController::class);
        Route::resource('/loan-evaluation',\App\Http\Controllers\administrator\loans\evaluationController::class);
        Route::resource('/deposits',\App\Http\Controllers\administrator\depositController::class);
        Route::resource('/repayments',\App\Http\Controllers\administrator\repaymentController::class);
        Route::resource('/reports',\App\Http\Controllers\administrator\reportController::class);
    });
});
