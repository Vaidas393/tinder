<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Livewire\AccountSetup\Step2;
use App\Livewire\AccountSetup\Step3;
use App\Livewire\AccountSetup\Step4;
use App\Livewire\AccountSetup\Step5;
use App\Livewire\HomePage;
use App\Livewire\EditProfile;
use App\Livewire\LoveMatches;
use App\Livewire\NotificationsPage;
use App\Http\Middleware\SetUserLocale;

// Public homepage
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});

// Guest-only routes (registration steps)
Route::middleware('guest')->group(function () {
    // Registration Step 1
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Registration Step 2 and 3 (Livewire)
    Route::get('account/setup/step2', Step2::class)->name('account.setup.step2');
    Route::get('account/setup/step3', Step3::class)->name('account.setup.step3');
    Route::get('account/setup/step4', Step4::class)->name('account.setup.step4');
    Route::get('account/setup/step5', Step5::class)->name('account.setup.step5');

    // Breeze auth routes (login, password reset)
    require __DIR__ . '/auth.php';
});

// Authenticated routes
Route::middleware(['auth', 'verified', SetUserLocale::class])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::get('/home', HomePage::class)->name('home');
    Route::get('/editprofile', EditProfile::class)->name('editProfile');
    Route::get('/matches', LoveMatches::class)->name('matches');
    Route::get('/notifications', NotificationsPage::class)->name('notifications');

    // Profile routes
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});
