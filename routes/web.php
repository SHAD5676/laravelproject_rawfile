<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;

/* Home */
Route::get('/', function () {
    return view('welcome');
});

/* User Dashboard */
Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* User Profile */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/* ================= ADMIN ================= */
Route::prefix('admin')->group(function () {

    // login
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'create'])->name('admin.login');
        Route::post('login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'store']);
    });

    // admin protected
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [App\Http\Controllers\Auth\Admin\LoginController::class, 'destroy'])->name('admin.logout');
        Route::view('dashboard', 'backend.admin_dashboard');

        // ✅ EMPLOYEE CRUD (ADMIN ONLY)
        Route::resource('employees', EmployeeController::class);
    });

});


/* ================= MANAGER ================= */
Route::prefix('manager')->group(function () {

    Route::middleware('guest:manager')->group(function () {
        Route::get('login', [App\Http\Controllers\Auth\Manager\LoginController::class, 'create'])->name('manager.login');
        Route::post('login', [App\Http\Controllers\Auth\Manager\LoginController::class, 'store']);
    });

    Route::middleware('auth:manager')->group(function () {
        Route::post('logout', [App\Http\Controllers\Auth\Manager\LoginController::class, 'destroy'])->name('manager.logout');
        Route::view('dashboard', 'backend.manager_dashboard');
    });

});


/* ================= EMPLOYEE ================= */
Route::prefix('employee')->group(function () {

    Route::middleware('guest:employee')->group(function () {
        Route::get('login', [App\Http\Controllers\Auth\Employee\LoginController::class, 'create'])->name('employee.login');
        Route::post('login', [App\Http\Controllers\Auth\Employee\LoginController::class, 'store']);
    });

    Route::middleware('auth:employee')->group(function () {
        Route::post('logout', [App\Http\Controllers\Auth\Employee\LoginController::class, 'destroy'])->name('employee.logout');
        Route::view('dashboard', 'backend.employee_dashboard');
    });

});

require __DIR__.'/auth.php';
