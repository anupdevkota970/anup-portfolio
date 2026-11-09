<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Skill;

// ─── Public Portfolio ────────────────────────────────────────────────────────
Route::get('/',        [PortfolioController::class, 'index'])->name('home');
Route::post('/contact', [PortfolioController::class, 'contact'])->name('contact.send');

// ─── Admin Auth ──────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login',  [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin')->group(function () {

        Route::get('/',          [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // Profile
        Route::get('/profile',        [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile',       [ProfileController::class, 'update'])->name('profile.update');

        // Projects
        Route::get('/projects',              [ProjectController::class, 'index'])->name('projects.index');
        Route::get('/projects/create',       [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects',             [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}/edit',   [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}',        [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}',     [ProjectController::class, 'destroy'])->name('projects.destroy');
        Route::post('/projects/{project}/toggle', [ProjectController::class, 'toggleActive'])->name('projects.toggle');

        // Skills
        Route::get('/skills',              [SkillController::class, 'index'])->name('skills.index');
        Route::get('/skills/create',       [SkillController::class, 'create'])->name('skills.create');
        Route::post('/skills',             [SkillController::class, 'store'])->name('skills.store');
        Route::get('/skills/{skill}/edit', [SkillController::class, 'edit'])->name('skills.edit');
        Route::put('/skills/{skill}',      [SkillController::class, 'update'])->name('skills.update');
        Route::delete('/skills/{skill}',   [SkillController::class, 'destroy'])->name('skills.destroy');

        // Photos
        Route::get('/photos',              [PhotoController::class, 'index'])->name('photos.index');
        Route::post('/photos',             [PhotoController::class, 'store'])->name('photos.store');
        Route::put('/photos/{photo}',      [PhotoController::class, 'update'])->name('photos.update');
        Route::delete('/photos/{photo}',   [PhotoController::class, 'destroy'])->name('photos.destroy');

        // Testimonials
        Route::get('/testimonials',                    [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::get('/testimonials/create',             [TestimonialController::class, 'create'])->name('testimonials.create');
        Route::post('/testimonials',                   [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::get('/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::put('/testimonials/{testimonial}',      [TestimonialController::class, 'update'])->name('testimonials.update');
        Route::delete('/testimonials/{testimonial}',   [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

        // Messages
        Route::get('/messages',               [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}',     [MessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}',  [MessageController::class, 'destroy'])->name('messages.destroy');


        
    });
});
