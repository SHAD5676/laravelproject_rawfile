<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController; // Added this
use App\Http\Controllers\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\Manager\LoginController as ManagerLoginController;
use App\Http\Controllers\Auth\Employee\LoginController as EmployeeLoginController;

/* ================= PUBLIC ROUTES ================= */

Route::get('/', function () {
    return view('welcome');
});

/* ================= USER (WEB) ROUTES ================= */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('dashboard');

    // Profile routes
    Route::prefix('profile')->name('profile.')->group(function () {
        // FIXED: Replaced standard text with proper Markdown for formatting
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });
});

/* ================= ADMIN ROUTES ================= */
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes (not logged in as admin)
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminLoginController::class, 'create'])->name('login');
        Route::post('login', [AdminLoginController::class, 'store']);
    });

    // Protected routes (logged in as admin)
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AdminLoginController::class, 'destroy'])->name('logout');

        Route::get('dashboard', function () {
            return view('backend.admin_dashboard');
        })->name('dashboard');

        // ✅ EMPLOYEE CRUD (ADMIN ONLY)
        Route::resource('employees', EmployeeController::class);
    });
});

/* ================= MANAGER ROUTES ================= */
Route::prefix('manager')->name('manager.')->group(function () {

    // Guest routes (not logged in as manager)
    Route::middleware('guest:manager')->group(function () {
        Route::get('login', [ManagerLoginController::class, 'create'])->name('login');
        Route::post('login', [ManagerLoginController::class, 'store']);
    });

    // Protected routes (logged in as manager)
    Route::middleware('auth:manager')->group(function () {
        Route::post('logout', [ManagerLoginController::class, 'destroy'])->name('logout');
        Route::get('dashboard', function () {
            return view('backend.manager_dashboard');
        })->name('dashboard');
    });
});

/* ================= EMPLOYEE ROUTES ================= */
Route::prefix('employee')->name('employee.')->group(function () {

    // Guest routes (not logged in as employee)
    Route::middleware('guest:employee')->group(function () {
        Route::get('login', [EmployeeLoginController::class, 'create'])->name('login');
        Route::post('login', [EmployeeLoginController::class, 'store']);
    });

    // Protected routes (logged in as employee)
    Route::middleware('auth:employee')->group(function () {
        Route::post('logout', [EmployeeLoginController::class, 'destroy'])->name('logout');
        Route::get('dashboard', function () {
            return view('backend.employee_dashboard');
        })->name('dashboard');
    });
});

// Include authentication routes
require __DIR__ . '/auth.php';