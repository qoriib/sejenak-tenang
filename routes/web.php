<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Auth Routes (Laravel default)
Auth::routes();

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/settings', [HomeController::class, 'profileSettings'])->name('profile.settings');
    Route::put('/profile/settings', [HomeController::class, 'updateProfile'])->name('profile.update');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('articles', App\Http\Controllers\Admin\ArticleController::class);
        Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
        Route::patch('/payments/{payment}/verify', [App\Http\Controllers\Admin\PaymentController::class, 'verify'])->name('payments.verify');
        Route::patch('/payments/{payment}/reject', [App\Http\Controllers\Admin\PaymentController::class, 'reject'])->name('payments.reject');
        Route::resource('mood-tracker', App\Http\Controllers\Admin\MoodTrackerController::class);
        Route::resource('meditation', App\Http\Controllers\Admin\MeditationAudioController::class)
            ->except(['show']);
    });

    // User Routes
    Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
        // Consultations
        Route::get('/consultations', [App\Http\Controllers\User\ConsultationController::class, 'index'])->name('consultations.index');
        Route::get('/consultations/create', [App\Http\Controllers\User\ConsultationController::class, 'create'])->name('consultations.create');
        Route::post('/consultations', [App\Http\Controllers\User\ConsultationController::class, 'store'])->name('consultations.store');
        Route::get('/consultations/{consultation}', [App\Http\Controllers\User\ConsultationController::class, 'show'])->name('consultations.show');
        Route::post('/consultations/{consultation}/payment', [App\Http\Controllers\User\ConsultationController::class, 'uploadPayment'])->name('consultations.upload-payment');

        // Chat
        Route::get('/chat/{consultation}', [App\Http\Controllers\User\ChatController::class, 'show'])->name('chat.show');
        Route::post('/chat/{consultation}', [App\Http\Controllers\User\ChatController::class, 'store'])->name('chat.store');
        Route::post('/chat/{consultation}/heartbeat', [App\Http\Controllers\User\ChatController::class, 'heartbeat'])->name('chat.heartbeat');
        Route::post('/chat/{consultation}/typing', [App\Http\Controllers\User\ChatController::class, 'typing'])->name('chat.typing');
        Route::get('/chat/{consultation}/messages', [App\Http\Controllers\User\ChatController::class, 'getMessages'])->name('chat.messages');


        Route::get('/mood-tracker', [App\Http\Controllers\MoodtrackerController::class, 'index'])->name('mood-tracker.index');
        Route::post('/mood-tracker', [App\Http\Controllers\MoodtrackerController::class, 'store'])->name('mood-tracker.store');
        Route::get('/mood-tracker/history', [App\Http\Controllers\MoodtrackerController::class, 'history'])->name('mood-tracker.history');

        // Meditation
        Route::get('/meditation', [App\Http\Controllers\MeditationController::class, 'index'])->name('meditation.index');
    });

    // Psychologist Routes
    Route::prefix('psychologist')->name('psychologist.')->middleware('auth')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Psychologist\PsychologistController::class, 'dashboard'])->name('dashboard');
        Route::get('/consultations', [App\Http\Controllers\Psychologist\ConsultationController::class, 'index'])->name('consultations.index');
        Route::get('/consultations/{consultation}', [App\Http\Controllers\Psychologist\ConsultationController::class, 'show'])->name('consultations.show');
        Route::patch('/consultations/{consultation}/status', [App\Http\Controllers\Psychologist\ConsultationController::class, 'updateStatus'])->name('consultations.update-status');

        // Chat
        Route::get('/chat/{consultation}', [App\Http\Controllers\Psychologist\ChatController::class, 'show'])->name('chat.show');
        Route::post('/chat/{consultation}', [App\Http\Controllers\Psychologist\ChatController::class, 'store'])->name('chat.store');
        Route::post('/chat/{consultation}/heartbeat', [App\Http\Controllers\Psychologist\ChatController::class, 'heartbeat'])->name('chat.heartbeat');
        Route::post('/chat/{consultation}/typing', [App\Http\Controllers\Psychologist\ChatController::class, 'typing'])->name('chat.typing');
        Route::get('/chat/{consultation}/messages', [App\Http\Controllers\Psychologist\ChatController::class, 'getMessages'])->name('chat.messages');
    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
