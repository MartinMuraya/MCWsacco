<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\MemberDashboard;
use App\Livewire\LoanApplicationWizard;
use App\Livewire\HostelBookingWizard;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', MemberDashboard::class)->name('dashboard');
    Route::post('/logout', function() {
        auth()->logout();
        return redirect('/');
    })->name('logout');
});

Route::get('/loans/apply', LoanApplicationWizard::class)->name('loans.apply');
Route::get('/hostels/book', HostelBookingWizard::class)->name('hostels.book');
