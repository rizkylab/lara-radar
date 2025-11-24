<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DomainsController;
use App\Http\Controllers\SubdomainsController;
use App\Http\Controllers\PortsController;
use App\Http\Controllers\TechStackController;
use App\Http\Controllers\VulnerabilitiesController;
use App\Http\Controllers\CVEController;
use App\Http\Controllers\DarkwebController;
use App\Http\Controllers\BotnetController;
use App\Http\Controllers\PiiController;
use App\Http\Controllers\ThreatsController;
use App\Http\Controllers\AlertsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuditLogsController;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Domains
    Route::get('/domains', [DomainsController::class, 'index'])->name('domains.index');
    Route::get('/domains/{id}', [DomainsController::class, 'show'])->name('domains.show');
    Route::post('/domains', [DomainsController::class, 'store'])->name('domains.store');
    Route::put('/domains/{id}', [DomainsController::class, 'update'])->name('domains.update');
    Route::delete('/domains/{id}', [DomainsController::class, 'destroy'])->name('domains.destroy');

    // Subdomains
    Route::get('/subdomains', [SubdomainsController::class, 'index'])->name('subdomains.index');
    Route::get('/subdomains/{id}', [SubdomainsController::class, 'show'])->name('subdomains.show');
    Route::post('/subdomains', [SubdomainsController::class, 'store'])->name('subdomains.store');
    Route::put('/subdomains/{id}', [SubdomainsController::class, 'update'])->name('subdomains.update');
    Route::delete('/subdomains/{id}', [SubdomainsController::class, 'destroy'])->name('subdomains.destroy');

    // Ports
    Route::get('/ports', [PortsController::class, 'index'])->name('ports.index');
    Route::get('/ports/{id}', [PortsController::class, 'show'])->name('ports.show');
    Route::post('/ports', [PortsController::class, 'store'])->name('ports.store');
    Route::delete('/ports/{id}', [PortsController::class, 'destroy'])->name('ports.destroy');

    // Tech Stack
    Route::get('/tech-stack', [TechStackController::class, 'index'])->name('tech-stack.index');
    Route::get('/tech-stack/{id}', [TechStackController::class, 'show'])->name('tech-stack.show');
    Route::post('/tech-stack', [TechStackController::class, 'store'])->name('tech-stack.store');
    Route::delete('/tech-stack/{id}', [TechStackController::class, 'destroy'])->name('tech-stack.destroy');

    // Vulnerabilities
    Route::get('/vulnerabilities', [VulnerabilitiesController::class, 'index'])->name('vulnerabilities.index');
    Route::get('/vulnerabilities/{id}', [VulnerabilitiesController::class, 'show'])->name('vulnerabilities.show');
    Route::post('/vulnerabilities', [VulnerabilitiesController::class, 'store'])->name('vulnerabilities.store');
    Route::put('/vulnerabilities/{id}', [VulnerabilitiesController::class, 'update'])->name('vulnerabilities.update');
    Route::delete('/vulnerabilities/{id}', [VulnerabilitiesController::class, 'destroy'])->name('vulnerabilities.destroy');

    // CVE Intelligence
    Route::get('/cve', [CVEController::class, 'index'])->name('cve.index');
    Route::get('/cve/search', [CVEController::class, 'search'])->name('cve.search');
    Route::get('/cve/{id}', [CVEController::class, 'show'])->name('cve.show');

    // Dark Web Monitoring
    Route::get('/darkweb', [DarkwebController::class, 'index'])->name('darkweb.index');
    Route::get('/darkweb/{id}', [DarkwebController::class, 'show'])->name('darkweb.show');
    Route::post('/darkweb/{id}/verify', [DarkwebController::class, 'verify'])->name('darkweb.verify');
    Route::delete('/darkweb/{id}', [DarkwebController::class, 'destroy'])->name('darkweb.destroy');

    // Botnet
    Route::get('/botnet', [BotnetController::class, 'index'])->name('botnet.index');
    Route::get('/botnet/{id}', [BotnetController::class, 'show'])->name('botnet.show');
    Route::post('/botnet/{id}/status', [BotnetController::class, 'updateStatus'])->name('botnet.status');
    Route::delete('/botnet/{id}', [BotnetController::class, 'destroy'])->name('botnet.destroy');

    // PII Exposure
    Route::get('/pii', [PiiController::class, 'index'])->name('pii.index');
    Route::get('/pii/{id}', [PiiController::class, 'show'])->name('pii.show');
    Route::post('/pii/{id}/verify', [PiiController::class, 'verify'])->name('pii.verify');
    Route::delete('/pii/{id}', [PiiController::class, 'destroy'])->name('pii.destroy');

    // Threat Hunting
    Route::get('/threat-hunting', [ThreatsController::class, 'index'])->name('threat-hunting.index');
    Route::get('/threat-hunting/search', [ThreatsController::class, 'search'])->name('threat-hunting.search');

    // Alerts
    Route::get('/alerts', [AlertsController::class, 'index'])->name('alerts.index');
    Route::get('/alerts/{id}', [AlertsController::class, 'show'])->name('alerts.show');
    Route::post('/alerts/{id}/status', [AlertsController::class, 'updateStatus'])->name('alerts.status');
    Route::post('/alerts/mark-all-read', [AlertsController::class, 'markAllRead'])->name('alerts.mark-all-read');
    Route::delete('/alerts/{id}', [AlertsController::class, 'destroy'])->name('alerts.destroy');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/settings/api-keys', [SettingsController::class, 'apiKeys'])->name('settings.api-keys');
    Route::post('/settings/api-keys', [SettingsController::class, 'generateApiKey'])->name('settings.api-keys.generate');
    Route::delete('/settings/api-keys/{id}', [SettingsController::class, 'revokeApiKey'])->name('settings.api-keys.revoke');

    // Users & Roles
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');

    // Audit Logs
    Route::get('/audit-logs', [AuditLogsController::class, 'index'])->name('audit-logs.index');
    Route::get('/audit-logs/filter', [AuditLogsController::class, 'filter'])->name('audit-logs.filter');
    Route::get('/audit-logs/export', [AuditLogsController::class, 'export'])->name('audit-logs.export');
    Route::get('/audit-logs/{id}', [AuditLogsController::class, 'show'])->name('audit-logs.show');

    // Profile
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');
});
