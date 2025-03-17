<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\CheckApproval;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/informations', [ContentController::class, 'index'])->name('info');

Route::get('/cliniques', [ClinicController::class, 'index'])->name('clinics');
Route::get('/forum', [ThreadController::class, 'index'])->middleware(['auth', \App\Http\Middleware\CheckSubscription::class])->name('forum');

// Route::get('/forum', [ThreadController::class, 'index'])->middleware(['auth', 'subscription'])->name('forum');

// Page 
Route::middleware(['auth', 'verified'])->get('/pending-approval', function () {
    return view('auth.pending-approval');
})->name('pending-approval');

// Dashboard avec approbation
Route::middleware(['auth', 'verified', CheckApproval::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Routes liées au profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes administrateur
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::patch('/users/approve/{id}', [UserController::class, 'approve'])->name('admin.users.approve');
    Route::post('/users/subscribe/{id}', [UserController::class, 'subscribe'])->name('admin.users.subscribe');
    Route::post('/users/deactivate/{id}', [UserController::class, 'deactivate'])->name('admin.users.deactivate'); // Nouvelle route
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Routes pour les cliniques
// Route::middleware(['auth', 'role:clinic', 'subscription'])->group(function () {
//     Route::get('/clinics/services', [ClinicController::class, 'services'])->name('clinics.services');
//     Route::get('/clinics/profile', [ClinicController::class, 'profile'])->name('clinics.profile');
//     Route::patch('/clinics/profile', [ClinicController::class, 'updateProfile'])->name('clinics.profile.update');
// });

Route::middleware(['auth', 'role:clinic', \App\Http\Middleware\CheckSubscription::class])->group(function () {
    Route::get('/clinics/services', [ClinicController::class, 'services'])->name('clinics.services');
    Route::patch('/clinics/services', [ClinicController::class, 'updateServices'])->name('clinics.services.update'); 
    Route::get('/clinics/profile', [ClinicController::class, 'profile'])->name('clinics.profile');
    Route::patch('/clinics/profile', [ClinicController::class, 'updateProfile'])->name('clinics.profile.update');
});

require __DIR__.'/auth.php';