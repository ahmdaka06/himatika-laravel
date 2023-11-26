<?php

use App\Http\Controllers\Guest\Seminar\RegisterController;
use App\Http\Controllers\UniversityController;
use Illuminate\Support\Facades\Route;

Route::prefix('seminar')->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->withoutMiddleware(['auth'])->name('guest.seminar.registerGET');
    Route::post('/register', [RegisterController::class, 'store'])->withoutMiddleware(['auth'])->name('guest.seminar.registerPOST');
    Route::get('/invoice/{invoice?}', [RegisterController::class, 'invoiceGET'])->withoutMiddleware(['auth'])->name('guest.seminar.invoiceGET');
    Route::post('/invoice', [RegisterController::class, 'invoicePOST'])->withoutMiddleware(['auth'])->name('guest.seminar.invoicePOST');
    Route::get('/upload-pay-proof/{participant:id}', [RegisterController::class, 'uploadPayProofGET'])->withoutMiddleware(['auth'])->name('guest.seminar.uploadPayProofGET');
    Route::post('/upload-pay-proof/{participant:id}', [RegisterController::class, 'uploadPayProofPOST'])->withoutMiddleware(['auth'])->name('guest.seminar.uploadPayProofPOST');
});

Route::prefix('university')->group(function () {
    Route::get('/search', [UniversityController::class, 'index'])->withoutMiddleware(['auth'])->name('universitas.searchGET');
});


