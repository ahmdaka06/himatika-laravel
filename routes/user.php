<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\NewsController;
use App\Http\Controllers\User\ParticipantController;
use App\Http\Controllers\User\WebsiteConfigController;
use App\Models\Participants;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'User', 'middleware' => ['auth']], function() {
    Route::prefix('auth')->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->withoutMiddleware(['auth'])->name('user.auth.loginGET');
        Route::post('/login', [LoginController::class, 'action'])->withoutMiddleware(['auth'])->name('user.auth.loginPOST');
        Route::get('/logout', [LoginController::class, 'logout'])->name('user.auth.logout');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('user.dashboard.index');

        Route::prefix('participants')->group(function () {
            Route::get('/', [ParticipantController::class, 'index'])->name('user.participant.index');
            Route::get('/form/{participant:id?}', [ParticipantController::class, 'formGET'])->name('user.participant.formGET');
            Route::post('/form/{participant:id?}', [ParticipantController::class, 'formPOST'])->name('user.participant.formPOST');
            Route::get('/detail/{participant:id}', [ParticipantController::class, 'detail'])->name('user.participant.detail');
            Route::get('/most-recommendation', [ParticipantController::class, 'mostRecommendations'])->name('user.participant.mostRecommendations');
        });

        Route::prefix('news')->group(function () {
            Route::get('/', [NewsController::class, 'index'])->name('user.news.index');
            Route::get('/form/{news:id?}', [NewsController::class, 'formGET'])->name('user.news.formGET');
            Route::post('/form/{news:id?}', [NewsController::class, 'formPOST'])->name('user.news.formPOST');
            Route::get('/detail/{news:id}', [NewsController::class, 'detail'])->name('user.news.detail');
        });

        Route::prefix('website-config')->group(function () {
            Route::get('/', [WebsiteConfigController::class, 'index'])->name('user.website-config.indexGET');
            Route::POST('/', [WebsiteConfigController::class, 'update'])->name('user.website-config.indexPOST');
        });
    });
});



