<?php

use App\Livewire\PayrollManager;
use App\Livewire\PayrollPaymentManager;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::view('posts', 'posts')
    ->middleware(['auth', 'verified'])
    ->name('posts');
Route::view('employees', 'employees')
    ->middleware(['auth', 'verified'])
    ->name('employees');



Route::get('payroll-manager', PayrollManager::class)->middleware(['auth'])->name('payroll.manager');

Route::get('payroll-payment-list', PayrollPaymentManager::class)->middleware(['auth'])->name('payroll.payment.list');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
