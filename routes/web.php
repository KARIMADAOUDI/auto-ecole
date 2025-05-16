<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleExpenseController;
use App\Http\Controllers\PersonalExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes pour les étudiants
    Route::resource('students', StudentController::class);

    // Routes pour les instructeurs
    Route::resource('instructors', InstructorController::class);

    // Routes pour les véhicules
    Route::resource('vehicles', VehicleController::class);

    // Routes pour les leçons
    Route::resource('lessons', LessonController::class);

    // Routes pour les paiements
    Route::resource('payments', PaymentController::class);

    // Routes pour les dépenses de véhicule
    Route::resource('vehicle-expenses', VehicleExpenseController::class);

    // Routes pour les dépenses personnelles
    Route::resource('personal-expenses', PersonalExpenseController::class);

    // Routes pour les factures
    Route::resource('invoices', InvoiceController::class);
    Route::post('/invoices/{invoice}/mark-as-paid', [InvoiceController::class, 'markAsPaid'])->name('invoices.mark-as-paid');

    // Routes pour le profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
});

require __DIR__.'/auth.php';
