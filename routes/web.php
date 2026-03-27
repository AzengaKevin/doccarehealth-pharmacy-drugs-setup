<?php

use App\Http\Controllers\DosageFormController;
use App\Http\Controllers\DrugController;
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

    Route::get('/drugs', [DrugController::class, 'index'])->name('drugs.index');
    Route::get('/drugs/create', [DrugController::class, 'create'])->name('drugs.create');
    Route::get('/drugs/export', [DrugController::class, 'export'])->name('drugs.exportDrugs');
    Route::post('/drugs/import', [DrugController::class, 'import'])->name('drugs.importDrugs');
    Route::post('/drugs', [DrugController::class, 'store'])->name('drugs.store');
    Route::get('/drugs/{drug}', [DrugController::class, 'show'])->name('drugs.show');
    Route::get('/drugs/{drug}/edit', [DrugController::class, 'edit'])->name('drugs.edit');
    Route::put('/drugs/{drug}', [DrugController::class, 'update'])->name('drugs.update');
    Route::delete('/drugs/{drug}', [DrugController::class, 'destroy'])->name('drugs.destroy');
});

require __DIR__.'/settings.php';
