<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.post');
    
    Route::get('/forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'edit'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'update'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        $stats = [
            'domains' => 25,
            'subdomains' => 342,
            'ports' => 1205,
            'vulnerabilities' => 47
        ];
        return view('dashboard.index', compact('stats'));
    })->name('dashboard');

    // Domains
    Route::get('/domains', function () {
        return view('domains.index');
    })->name('domains.index');

    Route::get('/domains/{id}', function ($id) {
        return view('domains.show', compact('id'));
    })->name('domains.show');

    // Subdomains
    Route::get('/subdomains', function () {
        return view('subdomains.index');
    })->name('subdomains.index');

    // Ports
    Route::get('/ports', function () {
        return view('ports.index');
    })->name('ports.index');

    // Tech Stack
    Route::get('/tech-stack', function () {
        return view('tech-stack.index');
    })->name('tech-stack.index');

    // Vulnerabilities
    Route::get('/vulnerabilities', function () {
        return view('vulnerabilities.index');
    })->name('vulnerabilities.index');

    // CVE Intelligence
    Route::get('/cve', function () {
        return view('cve.index');
    })->name('cve.index');

    // Dark Web Monitoring
    Route::get('/darkweb', function () {
        return view('darkweb.index');
    })->name('darkweb.index');

    // Botnet
    Route::get('/botnet', function () {
        return view('botnet.index');
    })->name('botnet.index');

    // PII Exposure
    Route::get('/pii', function () {
        return view('pii.index');
    })->name('pii.index');

    // Threat Hunting
    Route::get('/threat-hunting', function () {
        return view('threat-hunting.index');
    })->name('threat-hunting.index');

    // Alerts
    Route::get('/alerts', function () {
        return view('alerts.index');
    })->name('alerts.index');

    // Settings
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');

    // Users & Roles
    Route::get('/users', function () {
        return view('users.index');
    })->name('users.index');

    // Audit Logs
    Route::get('/audit-logs', function () {
        return view('audit-logs.index');
    })->name('audit-logs.index');

    // Profile
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
});
