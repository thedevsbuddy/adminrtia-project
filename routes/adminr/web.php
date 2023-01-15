<?php

use App\Http\Controllers\Adminr\UserController;
use App\Http\Controllers\Adminr\TemplateController;
use App\Http\Controllers\Adminr\SettingController;
use App\Http\Controllers\Adminr\BuilderController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'adminr', 'as' => 'adminr.'], function (){
    Route::get('/', [BuilderController::class, 'index'])->name('dashboard');

    /// Manage Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    /// Roles and Permissions routes
    Route::get('/roles-and-permissions', [RoleAndPermissionController::class, 'index'])->name('roles-and-permissions.index');
    Route::post('/assign-permission', [RoleAndPermissionController::class, 'assignPermission'])->name('roles-and-permissions.assign');
    Route::post('/revoke-permission', [RoleAndPermissionController::class, 'revokePermission'])->name('roles-and-permissions.revoke');
    Route::post('/store-role', [RoleAndPermissionController::class, 'storeRole'])->name('roles-and-permissions.storeRole');
    Route::post('/store-permission', [RoleAndPermissionController::class, 'storePermission'])->name('roles-and-permissions.storePermission');

    /// Mail Templates Routes
    Route::resource('/templates', TemplateController::class);

    /// Settings routes
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function (){
        Route::post('/', [SettingController::class, 'store'])->name('store');
        Route::get('/general', [SettingController::class, 'general'])->name('general');
        Route::get('/email', [SettingController::class, 'email'])->name('email');
        Route::get('/features', [SettingController::class, 'features'])->name('features');
    });
});
