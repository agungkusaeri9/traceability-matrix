<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTeamController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

// admin
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // roles
    Route::resource('roles', RoleController::class)->except('show');
    // permissions
    Route::resource('permissions', PermissionController::class)->except('show');
    // project
    Route::resource('project', ProjectController::class)->except('show');
    Route::controller(ProjectTeamController::class)->group(function () {
        Route::get('/project/{project_uuid}/team', 'index')->name('project-team.index');
        Route::get('/project/{project_uuid}/team/create', 'create')->name('project-team.create');
        Route::post('/project/{project_uuid}/team/create', 'store')->name('project-team.store');
        Route::delete('/project/{uuid}/team/delete', 'destroy')->name('project-team.destroy');
    });
});
