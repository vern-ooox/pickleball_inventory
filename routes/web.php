<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('equipment.index'));

// Breeze redirects here after login, so send it to the equipment list
Route::get('/dashboard', fn () => redirect()->route('equipment.index'))
    ->middleware('auth')
    ->name('dashboard');

// Every administrator page requires login
Route::middleware('auth')->group(function () {
    Route::resource('equipment', EquipmentController::class);

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('reports.pdf');
    Route::get('/reports/excel', [ReportController::class, 'exportExcel'])->name('reports.excel');
});

require __DIR__.'/auth.php';