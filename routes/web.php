<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');
Route::post('/check-cpf', [RegistrationController::class, 'checkCpf'])->name('registration.check-cpf');

// Redireciona o dashboard padrão para o administrativo
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes (único bloco)
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    
    // Registrations
    Route::get('/registrations', [App\Http\Controllers\AdminController::class, 'registrations'])->name('registrations');
    Route::get('/registrations/{registration}', [App\Http\Controllers\AdminController::class, 'registrationShow'])->name('registrations.show');
    Route::get('/registrations/{registration}/pdf', [App\Http\Controllers\AdminController::class, 'registrationPdf'])->name('registrations.pdf');
    
    // Gallery
    Route::get('/gallery', [App\Http\Controllers\AdminController::class, 'gallery'])->name('gallery');
    Route::get('/gallery/create', [App\Http\Controllers\AdminController::class, 'galleryCreate'])->name('gallery.create');
    Route::post('/gallery', [App\Http\Controllers\AdminController::class, 'galleryStore'])->name('gallery.store');
    Route::get('/gallery/{image}/edit', [App\Http\Controllers\AdminController::class, 'galleryEdit'])->name('gallery.edit');
    Route::put('/gallery/{image}', [App\Http\Controllers\AdminController::class, 'galleryUpdate'])->name('gallery.update');
    Route::delete('/gallery/{image}', [App\Http\Controllers\AdminController::class, 'galleryDestroy'])->name('gallery.destroy');
    
    // Partners
    Route::get('/partners', [App\Http\Controllers\AdminController::class, 'partners'])->name('partners');
    Route::get('/partners/create', [App\Http\Controllers\AdminController::class, 'partnersCreate'])->name('partners.create');
    Route::post('/partners', [App\Http\Controllers\AdminController::class, 'partnersStore'])->name('partners.store');
    Route::get('/partners/{partner}/edit', [App\Http\Controllers\AdminController::class, 'partnersEdit'])->name('partners.edit');
    Route::put('/partners/{partner}', [App\Http\Controllers\AdminController::class, 'partnersUpdate'])->name('partners.update');
    Route::delete('/partners/{partner}', [App\Http\Controllers\AdminController::class, 'partnersDestroy'])->name('partners.destroy');
    
    // Users
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    
    // Settings
    Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [App\Http\Controllers\AdminController::class, 'settingsUpdate'])->name('settings.update');
    
    // Schedule
    Route::get('/schedule', [App\Http\Controllers\AdminController::class, 'schedule'])->name('schedule');
    Route::get('/schedule/create', [App\Http\Controllers\AdminController::class, 'scheduleCreate'])->name('schedule.create');
    Route::post('/schedule', [App\Http\Controllers\AdminController::class, 'scheduleStore'])->name('schedule.store');
    Route::get('/schedule/{scheduleItem}/edit', [App\Http\Controllers\AdminController::class, 'scheduleEdit'])->name('schedule.edit');
    Route::put('/schedule/{scheduleItem}', [App\Http\Controllers\AdminController::class, 'scheduleUpdate'])->name('schedule.update');
    Route::delete('/schedule/{scheduleItem}', [App\Http\Controllers\AdminController::class, 'scheduleDestroy'])->name('schedule.destroy');

    // WhatsApp Groups
    Route::get('/whatsapp', [App\Http\Controllers\AdminController::class, 'whatsappGroups'])->name('whatsapp.index');
    Route::get('/whatsapp/create', [App\Http\Controllers\AdminController::class, 'whatsappCreate'])->name('whatsapp.create');
    Route::post('/whatsapp', [App\Http\Controllers\AdminController::class, 'whatsappStore'])->name('whatsapp.store');
    Route::get('/whatsapp/{group}/edit', [App\Http\Controllers\AdminController::class, 'whatsappEdit'])->name('whatsapp.edit');
    Route::put('/whatsapp/{group}', [App\Http\Controllers\AdminController::class, 'whatsappUpdate'])->name('whatsapp.update');
    Route::delete('/whatsapp/{group}', [App\Http\Controllers\AdminController::class, 'whatsappDestroy'])->name('whatsapp.destroy');
});

require __DIR__.'/auth.php';
