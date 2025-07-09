<?php

use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->hasRole('admin')) {
        return redirect()->route('dashboard');
    }

    if ($user->hasRole('approver_1') || $user->hasRole('approver_2')) {
        return redirect()->route('approvals.index');
    }

    return redirect()->route('reservations.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/approvals', [ApprovalController::class, 'index'])->name('approvals.index');
    Route::patch('/approvals/{reservation}', [ApprovalController::class, 'update'])->name('approvals.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/reports/reservations', [ReportController::class, 'index'])->name('reports.reservations.index');
    Route::get('/reports/reservations/export', [ReportController::class, 'export'])->name('reports.reservations.export');
});

Route::get('/activity-logs', function () {
    if (!auth()->user()->hasRole('admin')) {
        abort(403, 'Unauthorized.');
    }

    $logs = \App\Models\ActivityLog::latest()->paginate(5);
    return view('logs.index', compact('logs'));
})->middleware('auth')->name('activity.logs.index');


require __DIR__ . '/auth.php';
