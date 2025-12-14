<?php
// Ensure helper functions are always loaded regardless of the working directory
include __DIR__ . '/functions.php';

use Illuminate\Support\Facades\Route;
use Meetahir\LaravelWebInstaller\Controllers\RequirementsController;
use Meetahir\LaravelWebInstaller\Controllers\WelcomeController;
use Meetahir\LaravelWebInstaller\Controllers\EnvironmentController;
use Meetahir\LaravelWebInstaller\Controllers\PermissionsController;
use Meetahir\LaravelWebInstaller\Controllers\DatabaseController;
use Meetahir\LaravelWebInstaller\Controllers\FinalController;
use Meetahir\LaravelWebInstaller\Controllers\SuperAdminController;

Route::group(['prefix' => 'install', 'as' => 'LaravelInstaller::', 'middleware' => ['web', 'install']], function () {
    Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

    Route::get('environment', [EnvironmentController::class, 'environment'])->name('environment');

    Route::get('environment/save', [EnvironmentController::class, 'save'])->name('environmentSave');

    // Super Admin creation step (after environment)
    Route::get('super-admin', [SuperAdminController::class, 'form'])->name('superAdmin');
    // Use GET to capture details via query params per requirement
    Route::get('super-admin/save', [SuperAdminController::class, 'store'])->name('superAdmin.store');

    Route::get('requirements', [RequirementsController::class, 'requirements'])->name('requirements');

    Route::get('permissions', [PermissionsController::class, 'permissions'])->name('permissions');

    Route::get('database', [DatabaseController::class, 'database'])->name('database');

    Route::get('final', [FinalController::class, 'finish'])->name('final');
});
