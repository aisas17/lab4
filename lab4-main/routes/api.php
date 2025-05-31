<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/Teachers')->group(function(){
    Route::get('/',[TeachersController::class, 'index']);
    Route::get('/{id}',[TeachersController::class, 'show']);
    Route::post('/store',[TeachersController::class, 'store']);
    Route::put('/{id}',[TeachersController::class, 'update']);
    Route::delete('/{id}',[TeachersController::class, 'destroy']);
});

Route::prefix('/Students')->group(function(){
    Route::get('/',[StudentsController::class, 'index']);
    Route::get('/{id}',[StudentsController::class, 'show']);
    Route::post('/store',[StudentsController::class, 'store']);
    Route::put('/{id}',[StudentsController::class, 'update']);
    Route::delete('/{id}',[StudentsController::class, 'destroy']);
});