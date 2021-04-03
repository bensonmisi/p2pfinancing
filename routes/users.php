<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\loanController;
use App\Http\Controllers\collateralImagesController;
use App\Http\Controllers\collateralController;
use App\Http\Controllers\subscriptionController;

Route::group(['middleware'=>['auth','checkSubscription']],function(){
    Route::group(['prefix'=>'dashboard'],function(){

       Route::get('/',[dashboardController::class,'index'])->name('dashboard');
      
        Route::get('/profile',[profileController::class,'index'])->name('profile.index');
        Route::post('/profile',[profileController::class,'update'])->name('profile.update');      
        Route::resource('/loanApplication',loanController::class);
        Route::resource('/collateralApplication',collateralController::class);
        Route::resource('/collateralImages',collateralImagesController::class);
        Route::resource('/roles',\App\Http\Controllers\rolesController::class);
        Route::resource('/modules',\App\Http\Controllers\modulesController::class);
        Route::resource('/users',\App\Http\Controllers\usersController::class);
        Route::resource('/assign',\App\Http\Controllers\assignController::class);
        Route::resource('/borrowers',\App\Http\Controllers\borrowersController::class);
        Route::resource('/offers',\App\Http\Controllers\offerController::class);
        Route::resource('/statements',\App\Http\Controllers\statementController::class);
        Route::resource('/disbursement',\App\Http\Controllers\disbursementController::class);
        Route::resource('/investments',\App\Http\Controllers\investmentController::class);
        Route::resource('/installments',\App\Http\Controllers\installmentsController::class);



    });
});
