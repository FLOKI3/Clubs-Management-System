<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'permission:Dashboard access'])->name('admin.')->prefix('admin')->group(function() {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    // Roles management (CRUD for roles)
    Route::get('/roles', [RoleController::class, 'index'])
        ->name('roles.index')
        ->middleware('permission:Manage roles');
    
    Route::get('/roles/create', [RoleController::class, 'create'])
        ->name('roles.create')
        ->middleware('permission:Create roles');

    Route::post('/roles', [RoleController::class, 'store'])
        ->name('roles.store')
        ->middleware('permission:Create roles');

    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
        ->name('roles.edit')
        ->middleware('permission:Edit roles');

    Route::put('/roles/{role}', [RoleController::class, 'update'])
        ->name('roles.update')
        ->middleware('permission:Edit roles');

    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
        ->name('roles.destroy')
        ->middleware('permission:Delete roles');

    // Assign and revoke permissions for roles
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])
        ->name('roles.permissions')
        ->middleware('permission:Manage permissions');

    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermissionTo'])
        ->name('roles.permissions.revoke')
        ->middleware('permission:Manage permissions');

    // Permissions management (CRUD for permissions)
    Route::get('/permissions', [PermissionController::class, 'index'])
        ->name('permissions.index')
        ->middleware('permission:Manage permissions');

    Route::get('/permissions/create', [PermissionController::class, 'create'])
        ->name('permissions.create')
        ->middleware('permission:Create permissions');

    Route::post('/permissions', [PermissionController::class, 'store'])
        ->name('permissions.store')
        ->middleware('permission:Create permissions');

    Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])
        ->name('permissions.edit')
        ->middleware('permission:Edit permissions');

    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])
        ->name('permissions.update')
        ->middleware('permission:Edit permissions');

    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])
        ->name('permissions.destroy')
        ->middleware('permission:Delete permissions');

    // Assign and remove roles from permissions
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])
        ->name('permissions.roles')
        ->middleware('permission:Manage permissions');

    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])
        ->name('permissions.roles.remove')
        ->middleware('permission:Manage permissions');

    // Users management (View, Assign Roles and Permissions)
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('permission:Manage users');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('users.show')
        ->middleware('permission:Manage users');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('permission:Delete users');

    // Assign and remove roles from users
    Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])
        ->name('users.roles')
        ->middleware('permission:Add roles');

    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])
        ->name('users.roles.remove')
        ->middleware('permission:Add roles');

    // Assign and revoke permissions from users
    Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])
        ->name('users.permissions')
        ->middleware('permission:Manage permissions');

    Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])
        ->name('users.permissions.revoke')
        ->middleware('permission:Manage permissions');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
