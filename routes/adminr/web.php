<?php

use App\Http\Controllers\Adminr\UserController;
use App\Http\Controllers\Adminr\BuilderController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'adminr', 'as' => 'adminr.'], function (){
    Route::get('/', [BuilderController::class, 'index'])->name('dashboard');

    // Manage Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
