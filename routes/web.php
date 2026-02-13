<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;

/* ================= HOME ================= */
Route::get('/', function () {
    return view('welcome');
});


/* ================= USER ================= */
Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/* ================= ADMIN ================= */
Route::prefix('admin')->name('admin.')->group(function () {

    // login
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'create'])->name('login');
        Route::post('login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'store']);
    });

    // protected
    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [App\Http\Controllers\Auth\Admin\LoginController::class, 'destroy'])->name('logout');

        Route::view('dashboard', 'backend.admin_dashboard')->name('dashboard');

        Route::resource('employees', EmployeeController::class);
    });

});


/* ================= MANAGER ================= */
Route::prefix('manager')->name('manager.')->group(function () {

    Route::middleware('guest:manager')->group(function () {
        Route::get('login', [App\Http\Controllers\Auth\Manager\LoginController::class, 'create'])->name('login');
        Route::post('login', [App\Http\Controllers\Auth\Manager\LoginController::class, 'store']);
    });

    Route::middleware('auth:manager')->group(function () {
        Route::post('logout', [App\Http\Controllers\Auth\Manager\LoginController::class, 'destroy'])->name('logout');

        Route::view('dashboard', 'backend.manager_dashboard')->name('dashboard');
    });

});


/* ================= EMPLOYEE ================= */
Route::prefix('employee')->name('employee.')->group(function () {
    Route::middleware('guest:employee')->group(function () {
        Route::get('login', [\App\Http\Controllers\Auth\Employee\LoginController::class,'create'])->name('login');
        Route::post('login', [\App\Http\Controllers\Auth\Employee\LoginController::class,'store']);
    });

    Route::middleware('auth:employee')->group(function () {
        Route::post('logout', [\App\Http\Controllers\Auth\Employee\LoginController::class,'destroy'])->name('logout');
        Route::view('dashboard', 'backend.employee_dashboard')->name('dashboard');
    });
});



require __DIR__.'/auth.php';
