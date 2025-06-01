<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UserAuthController;

/**
 * Redirect "/" to admin dashboard or login page depending on authentication.
 */
Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('admin.login');
});


Route::prefix('admin')->middleware(['web'])->group(function () {
    // Auth
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/register', [AuthController::class, 'showRegisterForm'])->name('admin.register.form');

    // Dashboard (protected)
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });
});

// Route::middleware('web')->post('/api/register', [UserAuthController::class, 'register']);


Route::get('/login', function () {
    return redirect()->route('admin.login');
});



Route::middleware('web')->get('/test-session', function () {
    return response()->json(['session' => session()->all(), 'csrf' => csrf_token()]);
});


require __DIR__ . '/auth.php';
