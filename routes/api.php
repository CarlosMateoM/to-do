<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthenticatedUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\NoteCategoryController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')->group(function () {
    
    
    Route::post('/login',       [AuthController::class, 'login']);
    Route::post('/register',    [AuthController::class, 'register']);
    
    Route::middleware('auth:sanctum')->group(function () {
        
        
        Route::apiResource('notes',             NoteController::class);
        Route::apiResource('categories',        CategoryController::class);
        Route::apiResource('notes.categories',  NoteCategoryController::class)
            ->only('store', 'destroy');
        
        
        Route::post('/images',              ImageController::class);
        Route::delete('/logout',            [AuthController::class, 'logout']);
        Route::get('/user',                 AuthenticatedUserController::class);
    });


});