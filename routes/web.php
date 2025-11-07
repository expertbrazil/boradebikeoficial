<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\KitDeliveryController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/route.kml', [HomeController::class, 'routeKml'])->name('route.kml');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');
Route::post('/check-cpf', [RegistrationController::class, 'checkCpf'])->name('registration.check-cpf');

// Redireciona o dashboard padrão para o administrativo
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/logout', function () {
    Auth::guard()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->middleware('auth')->name('logout.custom');

Route::get('/logout', function () {
    if (Auth::check()) {
        Auth::guard()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }

    return redirect()->route('login');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes (único bloco)
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    
    // Registrations
    Route::get('/registrations', [App\Http\Controllers\AdminController::class, 'registrations'])
        ->name('registrations')
        ->middleware('can:view-registrations');
    Route::get('/registrations/export', [App\Http\Controllers\AdminController::class, 'registrationsExport'])
        ->name('registrations.export')
        ->middleware('can:view-registrations');
    Route::get('/registrations/{registration}', [App\Http\Controllers\AdminController::class, 'registrationShow'])
        ->name('registrations.show')
        ->middleware('can:view-registrations');
    Route::get('/registrations/{registration}/pdf', [App\Http\Controllers\AdminController::class, 'registrationPdf'])
        ->name('registrations.pdf')
        ->middleware('can:view-registrations');

    // Kit Delivery
    Route::get('/kits', [KitDeliveryController::class, 'index'])
        ->name('kits.index')
        ->middleware('can:view-registrations');
    Route::post('/kits/{registration}/deliver', [KitDeliveryController::class, 'deliver'])
        ->name('kits.deliver')
        ->middleware('can:view-registrations');
    
    // Gallery
    Route::get('/gallery', [App\Http\Controllers\AdminController::class, 'gallery'])
        ->name('gallery')
        ->middleware('can:view-gallery');
    Route::get('/gallery/create', [App\Http\Controllers\AdminController::class, 'galleryCreate'])
        ->name('gallery.create')
        ->middleware('can:create-gallery');
    Route::post('/gallery', [App\Http\Controllers\AdminController::class, 'galleryStore'])
        ->name('gallery.store')
        ->middleware('can:create-gallery');
    Route::get('/gallery/{image}/edit', [App\Http\Controllers\AdminController::class, 'galleryEdit'])
        ->name('gallery.edit')
        ->middleware('can:edit-gallery');
    Route::put('/gallery/{image}', [App\Http\Controllers\AdminController::class, 'galleryUpdate'])
        ->name('gallery.update')
        ->middleware('can:edit-gallery');
    Route::delete('/gallery/{image}', [App\Http\Controllers\AdminController::class, 'galleryDestroy'])
        ->name('gallery.destroy')
        ->middleware('can:delete-gallery');
    
    // Partners
    Route::get('/partners', [App\Http\Controllers\AdminController::class, 'partners'])
        ->name('partners')
        ->middleware('can:view-partners');
    Route::get('/partners/create', [App\Http\Controllers\AdminController::class, 'partnersCreate'])
        ->name('partners.create')
        ->middleware('can:create-partners');
    Route::post('/partners', [App\Http\Controllers\AdminController::class, 'partnersStore'])
        ->name('partners.store')
        ->middleware('can:create-partners');
    Route::get('/partners/{partner}/edit', [App\Http\Controllers\AdminController::class, 'partnersEdit'])
        ->name('partners.edit')
        ->middleware('can:edit-partners');
    Route::put('/partners/{partner}', [App\Http\Controllers\AdminController::class, 'partnersUpdate'])
        ->name('partners.update')
        ->middleware('can:edit-partners');
    Route::delete('/partners/{partner}', [App\Http\Controllers\AdminController::class, 'partnersDestroy'])
        ->name('partners.destroy')
        ->middleware('can:delete-partners');
    
    // Users
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])
        ->name('users')
        ->middleware('can:view-users');
    Route::get('/users/create', [App\Http\Controllers\AdminController::class, 'usersCreate'])
        ->name('users.create')
        ->middleware('can:create-users');
    Route::post('/users', [App\Http\Controllers\AdminController::class, 'usersStore'])
        ->name('users.store')
        ->middleware('can:create-users');
    Route::get('/users/{user}/edit', [App\Http\Controllers\AdminController::class, 'usersEdit'])
        ->name('users.edit')
        ->middleware('can:edit-users');
    Route::put('/users/{user}', [App\Http\Controllers\AdminController::class, 'usersUpdate'])
        ->name('users.update')
        ->middleware('can:edit-users');
    Route::delete('/users/{user}', [App\Http\Controllers\AdminController::class, 'usersDestroy'])
        ->name('users.destroy')
        ->middleware('can:delete-users');
    Route::patch('/users/{user}/toggle', [App\Http\Controllers\AdminController::class, 'usersToggleStatus'])
        ->name('users.toggle')
        ->middleware('can:edit-users');

    // Roles
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    
    // Settings
    Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])
        ->name('settings')
        ->middleware('can:view-settings');
    Route::post('/settings', [App\Http\Controllers\AdminController::class, 'settingsUpdate'])
        ->name('settings.update')
        ->middleware('can:view-settings');

    // Parameters
    Route::get('/parameters', [App\Http\Controllers\AdminController::class, 'parameters'])
        ->name('parameters')
        ->middleware('can:view-parameters');
    Route::post('/parameters', [App\Http\Controllers\AdminController::class, 'parametersUpdate'])
        ->name('parameters.update')
        ->middleware('can:view-parameters');
    Route::post('/parameters/smtp/test', [App\Http\Controllers\AdminController::class, 'smtpTest'])
        ->name('parameters.smtp.test')
        ->middleware('can:view-parameters');
    
    // Schedule
    Route::get('/schedule', [App\Http\Controllers\AdminController::class, 'schedule'])
        ->name('schedule')
        ->middleware('can:view-events');
    Route::get('/schedule/create', [App\Http\Controllers\AdminController::class, 'scheduleCreate'])
        ->name('schedule.create')
        ->middleware('can:create-events');
    Route::post('/schedule', [App\Http\Controllers\AdminController::class, 'scheduleStore'])
        ->name('schedule.store')
        ->middleware('can:create-events');
    Route::get('/schedule/{scheduleItem}/edit', [App\Http\Controllers\AdminController::class, 'scheduleEdit'])
        ->name('schedule.edit')
        ->middleware('can:edit-events');
    Route::put('/schedule/{scheduleItem}', [App\Http\Controllers\AdminController::class, 'scheduleUpdate'])
        ->name('schedule.update')
        ->middleware('can:edit-events');
    Route::delete('/schedule/{scheduleItem}', [App\Http\Controllers\AdminController::class, 'scheduleDestroy'])
        ->name('schedule.destroy')
        ->middleware('can:delete-events');

    // WhatsApp Groups
    Route::get('/whatsapp', [App\Http\Controllers\AdminController::class, 'whatsappGroups'])
        ->name('whatsapp.index')
        ->middleware('can:view-whatsapp');
    Route::get('/whatsapp/create', [App\Http\Controllers\AdminController::class, 'whatsappCreate'])
        ->name('whatsapp.create')
        ->middleware('can:manage-whatsapp');
    Route::post('/whatsapp', [App\Http\Controllers\AdminController::class, 'whatsappStore'])
        ->name('whatsapp.store')
        ->middleware('can:manage-whatsapp');
    Route::get('/whatsapp/{group}/edit', [App\Http\Controllers\AdminController::class, 'whatsappEdit'])
        ->name('whatsapp.edit')
        ->middleware('can:manage-whatsapp');
    Route::put('/whatsapp/{group}', [App\Http\Controllers\AdminController::class, 'whatsappUpdate'])
        ->name('whatsapp.update')
        ->middleware('can:manage-whatsapp');
    Route::delete('/whatsapp/{group}', [App\Http\Controllers\AdminController::class, 'whatsappDestroy'])
        ->name('whatsapp.destroy')
        ->middleware('can:manage-whatsapp');
});

require __DIR__.'/auth.php';
