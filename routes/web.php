<?php

use App\Http\Controllers\Admin\ClubController;
use App\Http\Controllers\Admin\CourseController;
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

    Route::get('/users/{user}', [UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware('permission:Edit users');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('permission:Delete users');

    Route::put('/user/{user}', [UserController::class, 'update'])
        ->name('users.update')
        ->middleware('permission:Edit users');

    Route::get('/user/create', [UserController::class, 'create'])
        ->name('users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store');

    // Clubs
    Route::get('/clubs', [ClubController::class, 'index'])
        ->name('clubs.index')
        ->middleware('permission:Manage clubs');
    Route::delete('/clubs/{club}', [ClubController::class, 'destroy'])
        ->name('clubs.destroy')
        ->middleware('permission:Delete clubs');
    Route::get('/clubs/{club}/edit', [ClubController::class, 'edit'])
        ->name('clubs.edit')
        ->middleware('permission:Edit clubs');
    Route::put('/clubs/{club}', [ClubController::class, 'update'])
        ->name('clubs.update')
        ->middleware('permission:Edit clubs');
    Route::get('/clubs/create', [ClubController::class, 'create'])
        ->name('clubs.create')
        ->middleware('permission:Create rooms');
    Route::post('/clubs', [ClubController::class, 'store'])
        ->name('clubs.store')
        ->middleware('permission:Create clubs');

    // Rooms
    Route::get('/rooms', [RoomController::class, 'index'])
        ->name('rooms.index')
        ->middleware('permission:Manage rooms');
    Route::get('/rooms/create', [RoomController::class, 'create'])
        ->name('rooms.create')
        ->middleware('permission:Create rooms');
    Route::post('/rooms', [RoomController::class, 'store'])
        ->name('rooms.store')
        ->middleware('permission:Create rooms');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])
        ->name('rooms.destroy')
        ->middleware('permission:Delete rooms');
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])
        ->name('rooms.edit')
        ->middleware('permission:Edit rooms');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])
        ->name('rooms.update')
        ->middleware('permission:Edit rooms');

    // Lessons
    Route::get('/lessons', [LessonController::class, 'index'])
        ->name('lessons.index')
        ->middleware('permission:Manage lessons');
    Route::get('/lessons/create', [LessonController::class, 'create'])
        ->name('lessons.create')
        ->middleware('permission:Create lessons');
    Route::post('/lessons', [LessonController::class, 'store'])
        ->name('lessons.store')
        ->middleware('permission:Create lessons');
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])
        ->name('lessons.destroy')
        ->middleware('permission:Delete lessons');
    Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])
        ->name('lessons.edit')
        ->middleware('permission:Edit lessons');
    Route::put('/lessons/{lesson}', [LessonController::class, 'update'])
        ->name('lessons.update')
        ->middleware('permission:Edit lessons');

    // Courses
    Route::get('/courses', [CourseController::class, 'index'])
        ->name('courses.index')
        ->middleware('permission:Manage sessions');
    Route::get('/courses/create', [CourseController::class, 'create'])
        ->name('courses.create')
        ->middleware('permission:Create sessions');
    Route::post('/courses', [CourseController::class, 'store'])
        ->name('courses.store')
        ->middleware('permission:Create sessions');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])
        ->name('courses.destroy')
        ->middleware('permission:Delete sessions');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])
        ->name('courses.edit')
        ->middleware('permission:Edit sessions');
    Route::put('/courses/{course}', [CourseController::class, 'update'])
        ->name('courses.update')
        ->middleware('permission:Edit sessions');
    
    // PDF COURSES
    Route::get('/courses/export-pdf', [CourseController::class, 'exportPdf'])->name('courses.exportPdf');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
