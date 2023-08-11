<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\RolePermissionController;

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

// Route::get('/', PagesController::class);

Route::middleware(['auth', 'verified','rolePermission'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('settings', [SettingController::class, 'index'])->name('setting');
    Route::post('settings-update', [SettingController::class, 'update'])->name('setting.update');

    Route::resource('gallery', GalleryController::class);

    Route::resource('news', NewsController::class);

    Route::resource('news-category', NewsCategoryController::class);

    Route::resource('user', UserController::class);

    Route::get('role-permission', [RolePermissionController::class, 'index'])->name('role-permission');
    Route::post('role-permission', [RolePermissionController::class, 'store'])->name('role-permission');
    Route::post('role-permission/getPermissions', [RolePermissionController::class, 'getPermissions'])->name('role-permission.getPermissions');
    Route::put('role-permission/updateRolePermission', [RolePermissionController::class, 'updateRolePermission'])->name('role-permission.updateRolePermission');

    Route::post('role-permission/getUserRolePermissions', [RolePermissionController::class, 'getUserRolePermissions'])->name('role-permission.getUserRolePermissions');
    Route::put('role-permission/updateUserRolePermissions', [RolePermissionController::class, 'updateUserRolePermissions'])->name('role-permission.updateUserRolePermissions');

    Route::put('role-permission/updatePermission', [RolePermissionController::class, 'updatePermission'])->name('role-permission.updatePermission');
    Route::delete('role-permission/{role}', [RolePermissionController::class, 'destroy'])->name('role-permission.destroy');

});



Route::get('testmail', function () {
    $validated = array(
        'email' => 'testMail@gmail.com',
        'otp' => mt_rand(0, 100000)
    );

    return new App\Mail\OTPMail($validated);
});


require __DIR__ . '/auth.php';
