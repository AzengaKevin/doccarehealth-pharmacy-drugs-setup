<?php

use App\Http\Controllers\DosageFormController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::inertia('dashboard', 'Dashboard')->name('dashboard');

    Route::get('/dosage-forms', [DosageFormController::class, 'index'])->name('dosage-forms.index');
    Route::post('/dosage-forms', [DosageFormController::class, 'store'])->name('dosage-forms.store');
    Route::put('/dosage-forms/{dosageForm}', [DosageFormController::class, 'update'])->name('dosage-forms.update');
    Route::delete('/dosage-forms/{dosageForm}', [DosageFormController::class, 'destroy'])->name('dosage-forms.destroy');
});

require __DIR__.'/settings.php';
