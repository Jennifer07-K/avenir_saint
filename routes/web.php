<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckApproval;




Route::get('/test-auth', function () {
    dd(Auth::user());
})->middleware('auth');


// Route::middleware(['auth', 'check.approval'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard'); 
//     })->name('dashboard');
// });



// Page d'accueil
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/forum', [ThreadController::class, 'index'])->middleware(['auth', 'subscription'])->name('forum');

// Informations
Route::get('/informations', [ContentController::class, 'index'])->name('info');

// Cliniques
Route::get('/cliniques', [ClinicController::class, 'index'])->name('clinics');

// Forum
Route::get('/forum', [ThreadController::class, 'index'])->name('forum');

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware(['auth', 'check.approval'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
// });
Route::middleware(['auth', CheckApproval::class])->group(function () {
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
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::patch('/admin/users/{id}/approve', [UserController::class, 'approve'])->name('admin.users.approve');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});


// Routes clinique
// Route::middleware(['auth', 'role:clinic'])->group(function () {
//     Route::get('/clinics/services', function () {
//         return view('clinics.services');
//     })->name('clinics.services');
// });
Route::middleware(['auth', 'role:clinic', 'subscription'])->group(function () {
    Route::get('/clinics/services', [ClinicController::class, 'services'])->name('clinics.services');
    Route::get('/clinics/profile', [ClinicController::class, 'profile'])->name('clinics.profile');
    Route::patch('/clinics/profile', [ClinicController::class, 'updateProfile'])->name('clinics.profile.update');
});
require __DIR__.'/auth.php';

