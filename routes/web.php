<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\{
    EventsList,
    EventSeats,
    MyPurchases
};
use App\Livewire\Admin\{
    Events as AdminEvents,
    EventSeats as AdminEventSeats,
    Users as AdminUsers,
    Purchases as AdminPurchases
};
use App\Livewire\Admin\FailedAttempts as AdminFailedAttempts;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
Route::get('/', EventsList::class)->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/events', EventsList::class)->name('events');
    Route::get('/events/{event}/seats', EventSeats::class)->name('events.seats');
    Route::get('/purchases', MyPurchases::class)->name('purchases');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/events', AdminEvents::class)->name('admin.events');
    Route::get('/seats/{event}', AdminEventSeats::class)->name('admin.event.seats');
    Route::get('/users', AdminUsers::class)->name('admin.users');
    Route::get('/purchases', AdminPurchases::class)->name('admin.purchases');
    Route::get('/failed-attempts', AdminFailedAttempts::class)->name('admin.failed.attempts');
});


require __DIR__.'/auth.php';
