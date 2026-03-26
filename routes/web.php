<?php

use App\Http\Controllers\DosageFormController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::get('/dosage-forms', [DosageFormController::class, 'index'])->name('dosage-forms.index');
    Route::post('/dosage-forms', [DosageFormController::class, 'store'])->name('dosage-forms.store');
    Route::put('/dosage-forms/{dosageForm}', [DosageFormController::class, 'update'])->name('dosage-forms.update');
    Route::delete('/dosage-forms/{dosageForm}', [DosageFormController::class, 'destroy'])->name('dosage-forms.destroy');

    Route::get('/manufacturers', [ManufacturerController::class, 'index'])->name('manufacturers.index');
    Route::post('/manufacturers', [ManufacturerController::class, 'store'])->name('manufacturers.store');
    Route::put('/manufacturers/{manufacturer}', [ManufacturerController::class, 'update'])->name('manufacturers.update');
    Route::delete('/manufacturers/{manufacturer}', [ManufacturerController::class, 'destroy'])->name('manufacturers.destroy');
});

require __DIR__.'/settings.php';
