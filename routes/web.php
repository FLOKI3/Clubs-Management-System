<?php

use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'permission:Dashboard access'])->name('admin.')->prefix('dashboard')->group(function() {
    Route::get('/', [IndexController::class, 'index'])->name('index');

    // Roles management
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

    // Permissions management
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

    // Users management
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('permission:Manage users');

    Route::get('/users/{user}', [UserController::class, 'show'])
        ->name('users.show')
        ->middleware('permission:Edit users');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('permission:Delete users');

    Route::put('/user/{user}', [UserController::class, 'update'])
        ->name('users.update')
        ->middleware('permission:Edit users');

    // Clubs
    Route::get('/clubs', [ClubController::class, 'index'])
        ->name('clubs.index');
    Route::delete('/clubs/{club}', [ClubController::class, 'destroy'])
        ->name('clubs.destroy');
    Route::get('/clubs/{club}/edit', [ClubController::class, 'edit'])
        ->name('clubs.edit');
    Route::put('/clubs/{club}', [ClubController::class, 'update'])
        ->name('clubs.update');
    // Create Clubs Stepper
        // Step 1
    Route::get('/create-role', [ClubController::class, 'showStep1'])
        ->name('clubs.step1');
    Route::post('/create-role', [ClubController::class, 'processStep1']);
        // Step 2
    Route::get('/create-club', [ClubController::class, 'showStep2'])
        ->name('clubs.step2');
    Route::post('/create-club', [ClubController::class, 'processStep2']);
        // Step 3
    Route::get('/confirmation', [ClubController::class, 'showStep3'])
        ->name('clubs.step3');
    Route::post('/confirmation', [ClubController::class, 'submitAllSteps']);

    // Rooms
    Route::get('/rooms', [RoomController::class, 'index'])
        ->name('rooms.index');
    Route::get('/rooms/create', [RoomController::class, 'create'])
        ->name('rooms.create');
    Route::post('/rooms', [RoomController::class, 'store'])
        ->name('rooms.store');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])
        ->name('rooms.destroy');

    // Lessons
    Route::get('/lessons', [LessonController::class, 'index'])
        ->name('lessons');

    // Sessions
    Route::get('/sessions', [SessionController::class, 'index'])
        ->name('sessions');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
